#include <boost/thread.hpp>
#include <boost/chrono.hpp>
#include <iostream>
#include <string>
#include <sstream>
#include <cstdlib>
#include "rapidjson/document.h"
#include "rapidjson/writer.h"
#include "rapidjson/stringbuffer.h"
#include <fstream>
#include <cmath>
#include <wiringPi.h>
#include <curl/curl.h>

#include "server_socket.h"
#include "client_socket.h"
#include "sql.h"

using namespace std;
using namespace rapidjson;

    ostringstream url;
    const char* cc;
    Document d;
    Document d2;
    string s;
    extern boost::mutex a;
    boost::mutex a;
    double arrosage;
    int i = 0;

    int nbEv = 0;

    int ev1 = 1;
    int ev2 = 1;
    int ev3 = 1;
    int ev4 = 0;
    
    int heure = 0;

    int surface1 = 0;
    int surface2 = 0;
    int surface3 = 0;
    int surface4 = 0;
    
    int e = 0;
    int bz = 0;
    int bq = 0;
    
    bool m_pause; // a initialiser à "false" dans le constructeur si dans une classe ou dans le main
    boost::mutex m_pause_mutex; // variable for the mutex
    boost::condition_variable m_pause_changed; // condition variable, utile

    string jDate, jEvp, jPrecipitation;
    
    CURL *curl;
    CURLcode res;
    std::string readBuffer;
    
    aquasql connectBdd("localhost","root","enzolepd","aquatech");
    
void block_while_paused() // permet de bloquer le programme pendant que m_pause est vrai
{
    boost::unique_lock<boost::mutex> lock(m_pause_mutex); // initialise une variable lick en tant que mutex
    while(m_pause) // si m_pause est vrai
    {
        m_pause_changed.wait(lock); // permert de lock le mutex
    }
}

void set_paused(bool new_value) // change la valeur de la variable pause, permet de 'pauser' le thread
{
    {
        boost::unique_lock<boost::mutex> lock(m_pause_mutex); // reinitialise la variable lock qui est la même que au dessus
        m_pause = new_value; // change la valeur de m_pause en fonction de la valeur donnée à la variable
    }
    m_pause_changed.notify_all();
    if(new_value == true) // simple retour visuel
    {
        std::cout << "thread en pause dejeuner ! " << std::endl;
    }
    else if(new_value == false)
    {
        std::cout << "thread recommence a travailler !" << std::endl;
    }
}

static size_t WriteCallback(void *contents, size_t size, size_t nmemb, void *userp)
{
    ((std::string*)userp)->append((char*)contents, size *nmemb);
    return size *nmemb;
}

double calculArrosage(const int surface)
{
    double whole, fractional;
    //lock le mutex le temps de la manipulation de variables afin de ne pas avoir de surprises
    a.lock();
    //calcul d'arrosage
    arrosage = (((atof(jEvp.c_str()) - atof(jPrecipitation.c_str())) / 1000 ) * surface) * 1000;
    //arrosage = 3;
    //petit algorithme matematique qui, comme l'on ne peut pas arosser de fraction de litre, s'occupe d'arrondir le nombre a l'unite inferieur ou superieur selon la valeur decimale
    fractional = modf(arrosage, &whole);

    if(fractional <= 0.5)
        arrosage = whole;
    else if(fractional > 0.5)
        arrosage = whole + 1;
    //tout est fini, debloque le mutex
    a.unlock();
    //retourne le nombre de litres
    return(arrosage);
}

void getData()
{
        curl = curl_easy_init();
        if(curl)
        {
            curl_easy_setopt(curl, CURLOPT_URL, "127.0.0.1/settings.json");
            curl_easy_setopt(curl, CURLOPT_WRITEFUNCTION, WriteCallback);
            curl_easy_setopt(curl, CURLOPT_WRITEDATA, &readBuffer);
            res = curl_easy_perform(curl);
            curl_easy_cleanup(curl);
        }
        //cout << readBuffer << endl;
        
        d.Parse(readBuffer.c_str());
        
        nbEv = atoi(d["electrovannes"].GetString());
        
        switch(nbEv)
        {
            case 0 : 
            {
                ev1 = 0;
                ev2 = 0;
                ev3 = 0;
                ev4 = 0;
                surface1 = 0;
                surface2 = 0;
                surface3 = 0;
                surface4 = 0;
            }break;
            
            case 1 :
            {
                ev1 = 1;
                ev2 = 0;
                ev3 = 0;
                ev4 = 0;
                surface1 = atoi(d["surface1"].GetString());
                surface2 = 0;
                surface3 = 0;
                surface4 = 0;
            }break;
            
            case 2 :
            {
                ev1 = 1;
                ev2 = 1;
                ev3 = 0;
                ev4 = 0;
                surface1 = atoi(d["surface1"].GetString());
                surface2 = atoi(d["surface2"].GetString());
                surface3 = 0;
                surface4 = 0;
            }break;
            
            case 3 :
            {
                ev1 = 1;
                ev2 = 1;
                ev3 = 1;
                ev4 = 0;
                surface1 = atoi(d["surface1"].GetString());
                surface2 = atoi(d["surface2"].GetString());
                surface3 = atoi(d["surface3"].GetString());
                surface4 = 0;
            }break;
            
            case 4 :
            {
                ev1 = 1;
                ev2 = 1;
                ev3 = 1;
                ev4 = 1;
                surface1 = atoi(d["surface1"].GetString());
                surface2 = atoi(d["surface2"].GetString());
                surface3 = atoi(d["surface3"].GetString());
                surface4 = atoi(d["surface4"].GetString());
            }break;
                
        }
    
        
        cout << surface1 << endl;
        //recupere tout le contenu du fichier texte afin d'avoir les donnees meteo et utilisateurs
        fstream f("data.txt", fstream::in );
        getline( f, s, '\0');

        //ferme le fichier
        f.close();
        
        //parse la chaine de caractère json
        d2.Parse(s.c_str());

        //extrait les valeurs de la chaine de caractere
        jDate = d2["date1"].GetString();
        jEvp = d2["evp2"].GetString();
        jPrecipitation = d2["precipitation1"].GetString();

        cout << jDate << endl;
        cout << jEvp << endl;
        cout << jPrecipitation << endl;

        cout << calculArrosage(surface1) <<endl;
        cout << calculArrosage(surface2) <<endl;
        cout << calculArrosage(surface3) <<endl;
        cout << calculArrosage(surface4) <<endl;
}

void startTrame(string name, string trame, int surface, int ev)
{
    // si il faut envoyer au moins un litre et que l'electrovanne est attribué
    if(calculArrosage(surface) >= 1 && (ev == 1 || ev == 2 || ev == 3 || ev == 4))
    {
        //cree un socket et envoie la tramme
        aquaclientsocket initSocket2(name,3256);
        initSocket2.send(trame);
        //ferme le socket
        initSocket2.closeSocket();
    }
}

void stopTrame(int surface, int ev)
{
    //si la valeur du nombre de litre qui sont passes est egale au nombre de litre d'eau et que l'electrovanne est attribue
    if((i == calculArrosage(surface) || i+1 == calculArrosage(surface)) && (ev == 1 || ev == 2 || ev == 3 || ev == 4))
    {
        //envoie la tramme de fermeture generale, remet le nombre de litres compte a zero, incremente la variable suivant l'electrovanne et la variable de gestion d'allumage
        boost::this_thread::sleep_for(boost::chrono::seconds(3));
        aquaclientsocket envoieFabien("stopTrame",3256);
        envoieFabien.send("000000000");
        i = 0;
        e++;
        cout << " e : " <<  e << endl;
        bz = 0;
    }
}

void increment ()
{
    //s'occupe a chaque litre qui passe d'augmenter le nombre de litre et de voir si l'on doit eteindre une electrovanne
    i ++;
    std::cout << " i = " << i << std::endl;
    if(e == 0)
    {
    boost::this_thread::sleep_for(boost::chrono::seconds(1));
    stopTrame(surface1, ev1);
    }
    if(e == 1)
    {
        boost::this_thread::sleep_for(boost::chrono::seconds(1));
        stopTrame(surface2, ev2);
    }
    
    if(e == 2)
    {
        boost::this_thread::sleep_for(boost::chrono::seconds(1));
        stopTrame(surface3, ev3);
    }
    
    if(e == 3)
    {
        boost::this_thread::sleep_for(boost::chrono::seconds(1));
        stopTrame(surface4, ev4);
    }
}

void gestionAllumage()
{
    //s'occupe de voir si les electrovannes devrait etre allumees
    boost::this_thread::sleep_for(boost::chrono::seconds(2));
    for(;;)
    {
        block_while_paused();
        
        if(e == 0 && bz == 0)
        {
            // si electrovanne non parametre dans la configuration du site, endormir la fonction
            if(ev1 == 0)
            {
                e = 0;
                boost::this_thread::sleep_for(boost::chrono::hours(1));
            }
            else
            {
                // envoie de la trame de demarage electrovanne 1
                startTrame("ev1", "110000000",surface1, ev1);
                connectBdd.request("UPDATE trame SET value = '110000000' WHERE id=1;");
                bz = 1;
            }
        }
        
        if(e == 1 && bz == 0)
        {
            if(ev2 == 0)
            {
                e = 0;
                boost::this_thread::sleep_for(boost::chrono::hours(1));
            }
            else
            {
                // envoie de la trame de demarage electrovanne 2
                cout << "ok" << endl;
                startTrame("ev2", "001100000",surface2, ev2);
                connectBdd.request("UPDATE trame SET value = '001100000' WHERE id=1;");
                bz = 1;
            }
        }
        
        if(e == 2 && bz == 0)
        {
            if(ev3 == 0)
            {
                e = 0;

                boost::this_thread::sleep_for(boost::chrono::hours(1));
            }
            else
            {
                // envoie de la trame de demarage electrovanne 3
                startTrame("ev3", "000011000",surface3, ev3);
                connectBdd.request("UPDATE trame SET value = '000011000' WHERE id=1;");
                bz = 1;
            }
        }
        if(e == 3 && bz == 0)
        {
            if(ev4 == 0)
            {
                e = 0;
                boost::this_thread::sleep_for(boost::chrono::hours(1));
            }
            else
            {
                // envoie de la trame de demarage electrovanne 4
                startTrame("ev4", "000000110",surface4, ev4);
                connectBdd.request("UPDATE trame SET value = '000000110' WHERE id=1;");
                bz = 1;
                boost::this_thread::sleep_for(boost::chrono::hours(1));
            }
        }
    }
}

void pauseThread() // obligation d'initialiser un autre thread 'pauser' le thread, dans le main, cela ne marche pas, thread purement à but de test
{
    int sockfd; 
    char buffer[MAXLINE]; 
    struct sockaddr_in servaddr, cliaddr;
    int n;
    unsigned len;
    std::string sBuffer;
    
    std::cout << "Creation du server '" << "arret" << "' sur le port " << 3258 << std::endl;
	// Creation du socket 
    if ( (sockfd = socket(AF_INET, SOCK_DGRAM, 0)) < 0 ) { 
        //gestion des erreurs
        perror("Echec de creation du socket"); 
        exit(EXIT_FAILURE); 
    } 
     
    //Parametrages de l'alocation memoire
    memset(&servaddr, 0, sizeof(servaddr)); 
    memset(&cliaddr, 0, sizeof(cliaddr)); 
      
    // Parametres du socket
    servaddr.sin_family    = AF_INET; // dire au socket que l'adresse est de type IPv4 
    servaddr.sin_addr.s_addr = INADDR_ANY; //dire qu'il accepte une connexion de n'importe quel ip
    servaddr.sin_port = htons(3258); // definition du port 
      
    // "Bind" le socket a l'adresse du serveur 
    if ( bind(sockfd, (const struct sockaddr *)&servaddr,  
            sizeof(servaddr)) < 0 ) 
    { 
        perror("bind failed"); 
        exit(EXIT_FAILURE); 
    }
    
    //boucle inifine
	for(;;)
	{
    //met en place la variable de reception du message
	n = recvfrom(sockfd, (char *)buffer, MAXLINE,  
                MSG_WAITALL, ( struct sockaddr *) &cliaddr, 
                &len); 
    buffer[n] = '\0';
    //passage du contenu de la variable d'un format c a c++
    sBuffer = buffer;
    //affiche cette tramme
        
        if (sBuffer == "0")
        {
            std::cout << "arret imediat !" << std::endl;
            set_paused(true);
        }
        else if (sBuffer == "1")
        {
            std::cout << "redemarage !" << std::endl;
            set_paused(false);
        }
    }
}


int main(int argc, char* argv[])
{
    m_pause = false;
    //creation des threads
    boost::thread allum(&gestionAllumage);
    boost::thread p1(&pauseThread);

    //connexion a la base de donnees et met la valeur du nombre de litres d'eau qui ont ete utilise cette journee
    //connectBdd.request("DROP TABLE IF EXISTS debit;");
    //connectBdd.prep_request("INSERT INTO debit VALUES (NULL, ?);",12);
    
    //initialise le capteur du debit d'eau
    wiringPiSetupPhys();
    pinMode(12,INPUT);
    wiringPiISR(12,INT_EDGE_RISING, increment);
    
    //met les electrovannes dans leur etat par defaut
    aquaclientsocket initSocket("init",3256);
    initSocket.send("000000000");
    connectBdd.request("UPDATE trame SET value = '000000000' WHERE id=1;");
    
    //recupere les donnees
    getData();
    
    //ajoute les threads
    p1.join();
    allum.join();

}
