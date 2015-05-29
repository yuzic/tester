# Тестер 1.0 (Для тестирование Web сервисов, Api) <h1>
 Некоторые из возможностей:
 
1. Тестирование ссылок
2. Проверка на присутвие определенной строки
3. Проверка http статусов страницы
4. Отправка POST, GET параметров
5. Подержка работы сразу с несколькими сайтами.

#### Документация:
 
Для работы вам необходимо установить php >5.3, curl

#### Как правильно писать тесты:
1. Задайте настроки для сайтов в конфигурационном файле /config.php (по умолчанию тестируеться домен c ключом: stage )
2. Все тесты храняться в директории /acceptance, каждая директория внутри неё соотвествует названию сайта (желательно использовать имя ключа из кофнига)