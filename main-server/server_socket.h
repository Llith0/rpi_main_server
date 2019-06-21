#include <stdio.h> 
#include <stdlib.h> 
#include <unistd.h> 
#include <string.h> 
#include <sys/types.h> 
#include <sys/socket.h> 
#include <arpa/inet.h> 
#include <netinet/in.h>
#include <string>
#include <ostream>
#include <iostream>
#include <boost/thread.hpp>
#include <boost/chrono.hpp>

#define MAXLINE 2048 

class aquaserversocket 
{
public :
	int sockfd; 
    char buffer[MAXLINE]; 
    struct sockaddr_in servaddr, cliaddr;
    int n;
    unsigned len;
    std::string sBuffer;
    boost::mutex a;

    aquaserversocket(std::string typeofsocket, int port);
    void doThings(int port);


};
