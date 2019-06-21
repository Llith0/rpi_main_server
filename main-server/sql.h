#include <stdlib.h>
#include <iostream>
#include <string>

#include <cppconn/driver.h>
#include <cppconn/exception.h>
#include <cppconn/resultset.h>
#include <cppconn/statement.h>
#include <cppconn/prepared_statement.h>

class aquasql
{
public :
	sql::Driver* driver;
	sql::Connection* con;
	sql::Statement* stmt;
	sql::ResultSet* res;
	sql::SQLException* e;
	sql::PreparedStatement* prep_stmt;

	aquasql(std::string ip, std::string usr, std::string pwd, std::string db);
	void request(std::string statement);
	void prep_request(std::string statement, int value);
};
