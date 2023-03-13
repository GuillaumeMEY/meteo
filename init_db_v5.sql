drop table if exists Measures ;

create table if not exists Measures(
    id int not null AUTO_INCREMENT,
    created_at timestamp not null default  current_timestamp,
    type enum('temp', 'weather', 'pression', 'humidity'),
    value varchar(20),
    source enum('api', 'sensor'),
    
    constraint Measures_pk primary key (id)
);

insert into Measures (type, value, source) values(
    'temp',
    '12',
    'sensor'
);