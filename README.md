## Doctor Appointment Booking App
A very simple booking application written in AngularJS and PHP.
In order to create a new booking record, a user should supply the following:
- Username
- Reason for visit
- Start / end dates
- Time for a visit

## Online demo
Online demo: [here](http://www.gostaf.com/dvisit)

### Completed
- Add a new record
- Remove a record
- Show all records
- Input verification
- JSON reasons for visit
- CSS and elementary design

### Todo
- Update a record
- Folders structure and routing
- Zend expressive framework
- More Input verification
- More RESTful API
- Standatd PHPT or PHPUnit tests

### Database configuration
Table structure for the table [`Tdoc`]
```
CREATE TABLE Tdoc (
    ID int(11) unsigned auto_increment not null,
    uName varchar(32),
    vReason varchar(64),
    vDate datetime,
    vTime time, 
    primary key (ID),
    UNIQUE KEY ID_UNIQUE (ID))
    AUTO_INCREMENT=10000
    )
  ```

### Version
0.1.a
