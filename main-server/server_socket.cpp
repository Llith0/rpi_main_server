#include "server_socket.h"
#include "client_socket.h"

aquaserversocket::aquaserversocket(std::string typeofsocket, int port)
{
	std::cout << "Creation du server '" << typeofsocket << "' sur le port " << port << std::endl;
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
    servaddr.sin_port = htons(port); // definition du port 
      
    // "Bind" le socket a l'adresse du serveur 
    if ( bind(sockfd, (const struct sockaddr *)&servaddr,  
            sizeof(servaddr)) < 0 ) 
    { 
        perror("bind failed"); 
        exit(EXIT_FAILURE); 
    }
    //join la fonction qui defini les actions a faire en fonction de la tramme recu
    doThings(port);
}

void aquaserversocket::doThings(int port)
{
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
    std::cout << "Client " << " Trame : " << sBuffer << std::endl;

    //si la trame recu est 000000 et le port 3256
    if(sBuffer == "000000" && port == 3256)
    {
    	std::cout << "ok" << std::endl;
    }
    
    if(sBuffer == "1" && port == 3258)
    {
    	std::cout << "bloqué" << std::endl;
        aquaclientsocket crit("crit",3256);
        crit.send("000000000");
        boost::mutex::scoped_lock lock(a);
    }
    
    }
}
