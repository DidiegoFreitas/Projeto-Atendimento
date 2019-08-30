# !/bin/bash
sudo docker-compose up -d

sudo docker exec -i projeto-atendimento_db_1 mysql -uroot -pmydatabase project_db < dump/scripts/db.sql

sudo docker exec -i projeto-atendimento_db_1 mysql -uroot -pmydatabase project_db < dump/scripts/inserts.sql
