.PHONY: prepare
prepare:
	docker compose up --build -d

.PHONY: prepare-db
prepare-db:
	docker compose exec mysql /bin/bash -c "mysql -u root -proot -e 'DROP SCHEMA IF EXISTS project; CREATE SCHEMA project;'"
	docker compose exec mysql /bin/bash -c "mysql -u root -proot project < /database.sql"

.PHONY:ssh
ssh:
	docker exec -it bank_queue_tickets_web /bin/bash
