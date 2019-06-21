#include "sql.h"

aquasql::aquasql(std::string ip, std::string usr, std::string pwd, std::string db)
{
		//cree la connexion a la base de donnees et a la bonne base
		driver = get_driver_instance();
		con = driver->connect(ip,usr,pwd);
		con->setSchema(db);
		
		//gestion des erreurs de connexion
		if(!con)
		{
			std::cout << "Erreur de connexion : " << e->getErrorCode() << std::endl;
		}
		else
		{
			std::cout << "Connexion reussie ! " << std::endl;
		}
}

void aquasql::request(std::string statement)
{
	//envoie une requete a la base de donnees
	stmt = con->createStatement();
	stmt->execute(statement);
}

void aquasql::prep_request(std::string statement, int value)
{
	// envoie une requete preparee a la base de donnee
	prep_stmt = con->prepareStatement(statement);
	
	prep_stmt->setInt(1,value);
	prep_stmt->execute();
}
