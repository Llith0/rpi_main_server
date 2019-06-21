#include "client_socket.h"

aquaclientsocket::aquaclientsocket(std::string typeofsocket, int port)
{
    std::cout << "Creation du client '" << typeofsocket << "' sur le port " << port << std::endl;
    // Creation du socket
    if ( (sockfd = socket(AF_INET, SOCK_DGRAM, 0)) < 0 ) { 
        perror("Erreur lors de la creation du socket"); 
        exit(EXIT_FAILURE); 
    } 
  
    memset(&servaddr, 0, sizeof(servaddr)); 
      
    broadcastEnable=1;
    ret=setsockopt(sockfd, SOL_SOCKET, SO_BROADCAST, &broadcastEnable, sizeof(broadcastEnable));

    // Information pour le client
    servaddr.sin_family = AF_INET; // dire au client que l'ip de connexion est de type IPV4
    servaddr.sin_port = htons(port); // port de connexion 
    servaddr.sin_addr.s_addr = htonl(INADDR_BROADCAST); // dire au client d'envoyer sur toute les ip de broadcast
}

void aquaclientsocket::send(std::string message)
{
        //envoie du message
        sendto(sockfd, message.c_str(), strlen(message.c_str()), 0, (struct sockaddr *)&servaddr, sizeof(servaddr));  
        std::cout << "Trame envoyée !" << std::endl;
}

void aquaclientsocket::closeSocket()
{
    //ferme le socket
    close(sockfd);
}
