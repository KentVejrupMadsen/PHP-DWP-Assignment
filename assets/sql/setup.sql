

-- Setup references
alter table profile
	add constraint profile_profile_type_identity_fk
		foreign key ( profile_type ) references profile_type ( identity );

alter table profile_information
	add constraint profile_information_profile_identity_fk
		foreign key ( profile_id ) references profile ( identity );

alter table profile_information
	add constraint profile_information_person_name_identity_fk
		foreign key ( person_name_id ) references person_name ( identity );

alter table profile_information
	add constraint profile_information_person_address_identity_fk
		foreign key ( person_address_id ) references person_address ( identity );

alter table profile_information
	add constraint profile_information_person_email_identity_fk
		foreign key ( person_email_id ) references person_email( identity );


alter table contact
	add constraint contact_person_email_identity_fk
		foreign key ( to_id ) references person_email ( identity );
        
alter table contact
	add constraint contact_person_email_identity_fk_2
		foreign key ( from_id ) references person_email ( identity );


alter table associated_category
	add constraint associated_category_product_attribute_identity_fk
		foreign key ( product_attribute_id ) references product_attribute ( identity );

alter table associated_category
	add constraint associated_category_product_category_identity_fk
		foreign key ( product_category_id ) references product_category ( identity );

alter table associated_category
	add constraint associated_category_product_identity_fk
		foreign key ( product_id ) references product ( identity );


alter table brought_product
	add constraint brought_product_product_invoice_identity_fk
		foreign key ( invoice_id ) references product_invoice ( identity );

alter table brought_product
	add constraint brought_product_product_identity_fk
		foreign key ( product_id ) references product ( identity );


alter table product_entity
	add constraint product_entity_brought_product_identity_fk
		foreign key ( brought_id ) references brought_product ( identity );

alter table product_entity
	add constraint product_entity_product_identity_fk
		foreign key ( product_id ) references product ( identity );


alter table image
	add constraint image_image_identity_fk
		foreign key ( parent_id ) references image ( identity );

alter table image
	add constraint image_image_type_identity_fk
		foreign key ( image_type_id ) references image_type ( identity );


alter table product_used_images
	add constraint product_used_images_image_identity_fk
		foreign key ( image_preview_id ) references image ( identity );

alter table product_used_images
	add constraint product_used_images_image_identity_fk_2
		foreign key ( image_full_id ) references image ( identity );


alter table product_invoice
	add constraint product_invoice_person_address_identity_fk
		foreign key (address_id) references person_address (identity);

alter table product_invoice
	add constraint product_invoice_person_email_identity_fk
		foreign key (mail_id) references person_email (identity);

alter table product_invoice
	add constraint product_invoice_person_name_identity_fk
		foreign key (owner_name_id) references person_name (identity);



-- Index

-- Set Default to's
alter table profile alter column profile_type set default 1;

-- Views
create or replace view profile_model_view as
select profile.identity, profile.username, profile.password, profile_type.content as profile_type
from profile
left join profile_type on profile.profile_type = profile_type.identity;


create or replace view contact_model_view as
select contact.subject_title,
       contact.meesage,
       contact.has_been_send,
       contact.created_on,
       pe.content as from_email,
       p2.content as to_email
from contact
left join person_email pe on contact.from_id = pe.identity
left join person_email p2 on contact.to_id = p2.identity;


create view profile_information_model_view as
select profile_information.identity as profile_information_identity,
       profile_information.profile_id as profile_id,
       person_name.first_name as person_name_firstname,
       person_name.last_name as person_name_lastname,
       person_name.middle_name as person_name_middlename,

       person_address.country as person_address_country,
       person_address.street_name as person_address_street_name,
       person_address.street_address_number as person_address_number,
       person_address.zip_code as person_address_zip_code,

       person_email.content as person_email
from profile_information
left join person_name on profile_information.person_name_id = person_name.identity
left join person_address on person_address.identity = profile_information.person_address_id
left join person_email on person_email.identity = profile_information.person_email_id;

create or replace view  contact_model_view as
select contact.identity,
       contact.subject_title,
       contact.message,
       contact.has_been_send,
       contact.created_on,
       p1.content as from_mail,
       p2.content as to_mail
from contact
left join person_email p1 on p1.identity = contact.from_id
left join person_email p2 on p2.identity = contact.to_id;

create or replace view product_associated_category_view as
select associated_category.identity as associated_category_identity, pc.content as category, pa.content as attribute, associated_category.product_id
from associated_category
left join product_category pc on associated_category.product_category_id = pc.identity
left join product_attribute pa on associated_category.product_attribute_id = pa.identity;

create view product_invoice_view as
select product_invoice.identity as invoice_identity,
       product_invoice.total_price as invoice_total_price,
       product_invoice.invoice_registered as invoice_registered,
       pa.country as invoice_address_country,
       pa.street_name as invoice_address_street_name,
       pa.street_address_number as invoice_address_number,
       pa.zip_code as invoice_address_zip_code,
       pe.content as invoice_mail_to,
       pn.first_name as invoice_owner_firstname,
       pn.last_name as invoice_owner_lastname,
       pn.middle_name as invoice_owner_middle_name
from product_invoice
left join person_address pa on product_invoice.address_id = pa.identity
left join person_email pe on product_invoice.mail_id = pe.identity
left join person_name pn on product_invoice.owner_name_id = pn.identity;


create view product_invoice_view_short as
select product_invoice.identity as invoice_id,
       product_invoice.total_price,
       product_invoice.invoice_registered,
       concat(pa.street_name, ' ' , pa.street_address_number, ', ', pa.zip_code, ', ' , pa.country) as owner_address,
       pe.content as owner_mail,
       concat(pn.first_name,' ' ,pn.last_name,', ', pn.middle_name) as owner_name
from product_invoice
left join person_address pa on product_invoice.address_id = pa.identity
left join person_email pe on product_invoice.mail_id = pe.identity
left join person_name pn on product_invoice.owner_name_id = pn.identity;

create view product_available_units as
select product.identity, product.title, product.product_description, product.product_price, count(pe.product_id) as available_unit
from product
left join product_entity pe on product.identity = pe.product_id
group by product_id;

-- Triggers
create trigger person_name_insert_nomalise
before insert on person_name
    for each row
    set NEW.middle_name = lower( NEW.middle_name ),
        NEW.last_name   = lower( NEW.last_name ),
        NEW.first_name  = lower( NEW.first_name );

create trigger person_name_update_nomalise
before update on person_name
    for each row
    set NEW.middle_name = lower( NEW.middle_name ),
        NEW.last_name   = lower( NEW.last_name ),
        NEW.first_name  = lower( NEW.first_name );

create trigger person_email_insert_nomalise
before insert on person_email
    for each row
    set NEW.content = lower( NEW.content );

create trigger person_email_update_nomalise
before update on person_email
    for each row
    set NEW.content = lower( NEW.content );

create trigger person_address_insert_nomalise
before insert on person_address
    for each row
    set NEW.zip_code                = lower( NEW.zip_code ),
        NEW.street_address_number   = lower( NEW.street_address_number ),
        NEW.street_name             = lower( NEW.street_name ),
        NEW.country                 = lower( NEW.country );

create trigger person_address_update_nomalise
before update on person_address
    for each row
    set NEW.zip_code              = lower( NEW.zip_code ),
        NEW.street_address_number = lower( NEW.street_address_number ),
        NEW.street_name           = lower( NEW.street_name ),
        NEW.country               = lower( NEW.country );

create trigger article_on_update__update_timestamp
before update on article
    for each row
    set NEW.last_update = now();

create trigger image_on_update__update_timestamp
before update on image
    for each row
    set NEW.last_updated = now();

create trigger page_element_on_update__update_timestamp
before update on page_element
    for each row
    set NEW.last_update = now();

create trigger profile_type_insert_nomalise
before insert on profile_type
    for each row
    set NEW.content = lower( NEW.content );

create trigger profile_type_update_nomalise
before update on profile_type
    for each row
    set NEW.content = lower( NEW.content );

create trigger product_attribute_insert_nomalise
before insert on product_attribute
    for each row
    set NEW.content = lower( NEW.content );

create trigger product_attribute_update_nomalise
before update on product_attribute
    for each row
    set NEW.content = lower( NEW.content );


create trigger product_category_insert_nomalise
before insert on product_category
    for each row
    set NEW.content = lower( NEW.content );

create trigger product_category_update_nomalise
before update on product_category
    for each row
    set NEW.content = lower( NEW.content );

create trigger profile_normalise_insert_username
before insert on profile
    for each row
    set NEW.username = lower( NEW.username );

create trigger profile_normalise_update_username
before update on profile
    for each row
    set NEW.username = lower( NEW.username );



-- Insert Values
insert into product_attribute( content )
    values  ( 'ukendt' ),
            ( 'farve' ),
            ( 'tema' ),
            ( 'form' );


insert into product_category( content )
    values  ( 'ukendt' ),
            ( 'rød' ),
            ( 'gul' ),
            ( 'orange' ),
            ( 'blå' ),
            ( 'halloween' ),
            ( 'jul' ),
            ( 'forår' ),
            ( 'sommer' );

-- functions
create or replace function exists_email( mail varchar( 1024 ) ) returns int
begin
    declare mail_content varchar(1024) default null;
    declare mail_id int default 0;

    declare finished int default 0;
    declare found int default 0;

    declare cursor_for_person_emails cursor for select * from person_email where content = lower(mail);
    declare continue handler for not found set finished=1;

    open cursor_for_person_emails;

    getMails: LOOP
        fetch cursor_for_person_emails into mail_id, mail_content;

        if finished = 1 then
            leave getMails;
        end if;

        if mail_content = mail then
            set found = 1;
        end if;

    end loop;

    close cursor_for_person_emails;

    return found;
end;

create or replace function is_admin(value int) returns int
begin
    declare profile_type_id int default 0;

    declare finished int default 0;
    declare found int default 0;

    declare cursor_for_profile_type cursor for select identity from profile_type where content = lower('adminstrator');
    declare continue handler for not found set finished=1;

    open cursor_for_profile_type;

    getProfileType: LOOP
        fetch cursor_for_profile_type into profile_type_id;

        if finished = 1 then
            leave getProfileType;
        end if;

        if profile_type_id = value then
            set found = 1;
        end if;

    end loop;

    close cursor_for_profile_type;

    return found;
end;