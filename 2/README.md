## ЗАДАЧА

Что плохого в следующем условии. Как можно его изменить?
```
now() < date_add(`datetime_field`, interval 14 day)
```

## Ответ

Чтобы sql смог использовать индексы (если они имеются) запрос должен быть вида 
```
`datetime_field` > date_add(NOW(), interval - 14 day)
```
