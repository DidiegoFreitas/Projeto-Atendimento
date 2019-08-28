# !/bin/bash
sudo docker-compose exec projeto-atendimento_db_1 mysql -h hostname -u root -pmydatabase project_db < ../scripts/create/db.sql
