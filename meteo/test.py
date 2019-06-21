#librairies
import requests
from bs4 import BeautifulSoup
from time import gmtime, strftime
from datetime import datetime,timedelta
import locale
import mysql.connector as mariadb
import json
import time

#facilite la gestion des commandes en transformant les deux commandes necessaires a chaque fois en une fonction
def bddRequest(connect,cursor,instruction) :
	cursor.execute(instruction)
	connect.commit()

while True :
#emet la requete GET vers le site internet
	r = requests.get("https://www.prevision-meteo.ch/meteo/agricole/carcassonne") 

#initialisation de Beautiful soup en hmtl parser avec le contenu de la page html
	soup = BeautifulSoup(r.text, 'html.parser')

#connexion a la base de donnee
	mariadb_connection = mariadb.connect(user='root', password='', database='aquatech')
#retourne une erreur si connexion rate
	if mariadb_connection :
		print("connexion reussie")

#initilisation du curseur pour la base de donnee
	cursor = mariadb_connection.cursor()

#arange le code
	soup.prettify()

#declaration du tableau contenant les valeurs

	p = soup.find_all("td")

#print(p)

#creation de la table pour stocker les td de la page web
	tab = []

#recupere tout les td de la page (la ou sont stockes les valeurs de l'evapotranspiration et de la pluviometrie
	for evpL in soup.find_all("td"):
		tab.append(evpL.text)

#regle les formats tel que la date ou l'heure au format francais
	locale.setlocale(locale.LC_ALL, 'fr_FR.utf8') 

#recupere la date
	day = datetime.now()
#print(day)

	date,date2,date3,date4,date5 = ("",)*5
	evp1,evp2,evp3,evp4,evp5 = ("",)*5
	precip, precip2, precip3, precip4, precip5 = ("",)*5

#Recupere juste le jour de la date
	date = day.strftime("%A")
	bddDate = day.strftime("%Y-%m-%d %H:%M:%S")
#print(date)
	print(bddDate);

#creation d'un dictionnaire pour stocker nos variables qu'on converti directement en chaine de caractere json
	dict1 = json.dumps({'day' : date, 'evp' : str(tab[13]), 'precip' : str(tab[12])})

	print(dict1)

#ecrit le contenu de la chaine  de caractere dans le fichier json
	with open('C:\\Users\\kiki\\Desktop\\main_serv\\data.json', 'w') as outfile:
		outfile.write(dict1)

#lit le fichier json
	print(open('C:\\Users\\kiki\\Desktop\\main_serv\\data.json', 'r').read())

#cree la base de donnee, la table si tout cela n'existe pas et stock toute les valeurs dedans
	bddRequest(mariadb_connection,cursor,"INSERT INTO jour(jour, date, evp, precip) VALUES('"+str(date)+"','"+str(bddDate)+"','"+str(tab[13])+"','"+str(tab[12])+"');")

	cursor.close()
	mariadb_connection.close()
	time.sleep(60*60*24)
