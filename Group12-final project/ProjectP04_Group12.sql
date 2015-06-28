CREATE DATABASE BUSRESERVATION;
USE BUSRESERVATION;

CREATE TABLE OWNER ( 
 OwnerNIC integer(9) not null,
 Name varchar(20),
 Address varchar(30),
 ContactNO integer(10),
 Gender char(1),
 BirthDate date,
 PRIMARY KEY(OwnerNIC)
);



CREATE TABLE BUS (
 RegNO integer(5) not null,
 OwnerNIC integer(9),
 NOofSeats integer(2),
 Conditions varchar(8),
 PRIMARY KEY(RegNO),
 foreign key(OwnerNIC) references OWNER(OwnerNIC)
 on delete set NULL on update CASCADE
 );






CREATE TABLE ROUTE ( 
 RouteID integer(5),
 StartCity varchar(10),
 EndCity varchar(10),
 Fare integer(4),
 Distance varchar(3),
 Duration time,
 primary key(RouteID)
);



CREATE TABLE TIMESLOT (
 TSID integer(5),
 Date date, 
 Time time,
 RegNO integer(5),
 RouteID integer(5), 
 PRIMARY KEY(TSID), 
 foreign key(RegNO) references BUS(RegNO)
 on delete set NULL on update CASCADE,
 foreign key(RouteID) references ROUTE(RouteID)
 on delete set NULL on update CASCADE
);


CREATE TABLE SUBROUTE (
 RouteID integer(5) NOT NULL,
 SubrouteID integer(5), 
 primary key (RouteID,SubrouteID),
 foreign key(RouteId) references ROUTE(RouteID)
 on delete RESTRICT on update CASCADE, 
 foreign key(SubrouteID) references ROUTE(RouteID)
 on delete RESTRICT on update CASCADE
);
 


CREATE TABLE CUSTOMER (
 CustNIC integer(9) NOT NULL,
 Name varchar(20),
 Address varchar(30),
 ContactNO integer(10),
 Gender char(1),
 BirthDate date,
 primary key(CustNIC)
);



CREATE TABLE RESERVATION ( 
 TSID integer(5), 
 CustNIC integer(9), 
 SeatNO integer(2), 
 Date date,
 Amount integer(2),
 CreditCardNO char(12), 
 primary key (TSID,CustNIC,SeatNO),
 foreign key(TSID) references TIMESLOT(TSID)
 on delete CASCADE on update CASCADE, 
 foreign key(CustNIC) references CUSTOMER(CustNIC)
 on delete CASCADE on update CASCADE
);


CREATE TABLE ADMINACCOUNT(
UserName varchar(20) not null,
Password varchar(20) not null,
primary key(UserName)
);