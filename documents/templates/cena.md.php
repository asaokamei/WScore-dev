Cena Data Transfer Agnet
========================

Cena stands for Composed Entity Notation and Augmentation.

In essence, it is a __resource oriented transfer protocol__ which 
can represent entity properties as well as relationship for entities.

Cena can, 

*    build complex html forms,
*    synchronize databases between client and server, or 
     more rencently known as cloud and application.

As of this wrting (April, 2013), WScore only implements the 
first utilities. 


###identifying entity

For example, an entity representing a record in a table (MyFriend) 
with primary key (say, 10) can be identified as;

    Cena.MyFriend.get.10

Whereas, a new record can be represeted as;

    Cena.MyFriend.new.1

please note that 'get' and 'new' are just text to represents if 
the entities exists in database, or new.

In general, an entity can be identified as;

    Cena.model.type.id

where 

*   model: a model name representing a table in db.
*   type: represents if id is new or from db.
*   id: primary key.


###representing property

Properties of an entity can be identified and set its value as;

    Cena.MyFriend.get.10.prop.name = 'Thomas'
    Cena.MyFriend.new.1.prop.name = 'Percy'


###representing relationship

Cena can be used to transfer not just properties of entities, but 
also for trasfering relations between entities.  

For example, another table (say Contacts) is related to MyFriend entities

    Cena.MyFriend.new.1.link.contact = Cena.Contacts.new.11

Transfering relation has been very difficult in case when 
surrogate key was used to identify the relationship, such as 
auto-increment id. 

