# !/bin/bash

sudo docker exec -i projeto-atendimento_db_1 mysqldump -uroot -pmydatabase project_db > dump/dump_project_db.sql

sudo docker-compose stop
