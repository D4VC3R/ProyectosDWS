DELIMITER  //

drop table if exists village;

create table village
(
    id          int unsigned auto_increment,
    name        varchar(100),
    postal_code varchar(10)  NOT NULL,
    region      varchar(100) NOT NULL,
    latitude    decimal(10, 8),
    longitude   decimal(11, 8),

    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    constraint pk_village primary key (id),
    constraint uk_village_postal unique (postal_code)

);
//

drop table if exists user;

//

create table user
(

    uuid       varchar(60),
    username   varchar(30),
    password   varchar(255),
    email      varchar(255),
    village_id int UNSIGNED,

    type       enum ('NORMAL', 'PREMIUM', 'ADMIN') DEFAULT 'NORMAL',
    status     enum ('PENDING', 'ACTIVE', 'BANNED'),

    created_at TIMESTAMP                           DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP                           DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,

    constraint pk_user primary key (uuid),

    constraint uk_user_username unique (username),

    constraint uk_user_email unique (email)
);
//
alter table user
    add constraint fk_user_village
        foreign key (village_id) references village (id)
            on delete set null
            on update cascade;

//

drop table if exists user_profile
//

create table user_profile
(
    user_uuid          varchar(60),
    first_name         varchar(50),
    last_name          varchar(50),
    birthdate          date NOT NULL,
    phone              varchar(20),
    profession         varchar(100),
    biography          text,
    avatar             varchar(255),

    privacy_phone      TINYINT UNSIGNED DEFAULT 0 COMMENT 'O:PRIVATE, 1:VILLAGE, 2:PUBLIC',
    privacy_email      TINYINT UNSIGNED DEFAULT 0,
    privacy_bio        TINYINT UNSIGNED DEFAULT 1 COMMENT 'Bio visible a vecinos por defecto.',
    privacy_profession TINYINT UNSIGNED DEFAULT 1,

    updated_at         TIMESTAMP        DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP

);
//

alter table user_profile
    add constraint pk_user_profile primary key (user_uuid);
alter table user_profile
    add constraint fk_profile_user foreign key (user_uuid) references user (uuid)
        on delete cascade
        on update cascade;

//





drop table if exists service_ad;

//

create table service_ad
(
    id          int unsigned auto_increment,
    village_id  int unsigned              NOT NULL,
    author_uuid varchar(60)               NOT NULL,
    title       varchar(100)              NOT NULL,
    body        text                      NOT NULL,
    price_info  varchar(50),

    type        enum ('OFFER', 'REQUEST') NOT NULL,
    status      enum ('OPEN', 'CLOSED') DEFAULT 'OPEN',

    created_at  TIMESTAMP               DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP               DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,

    constraint pk_service_ad primary key (id),

    constraint fk_ad_village foreign key (village_id) references village (id)
        on delete cascade,

    constraint fk_ad_author foreign key (author_uuid) references user (uuid)
        on delete cascade
);

//

drop table if exists community_event;
//

create table community_event
(
    id            int unsigned auto_increment,
    village_id    int unsigned NOT NULL,
    author_uuid   varchar(60)  NOT NULL,

    title         varchar(100) NOT NULL,
    description   text,
    meeting_point varchar(150),

    event_at      DATETIME     NOT NULL,
    created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    constraint pk_community_event primary key (id),

    constraint fk_event_village foreign key (village_id) references village (id)
        on delete cascade,
    constraint fk_event_author foreign key (author_uuid) references user (uuid)
        on delete cascade
);

//

create index idx_ad_village on service_ad (village_id);
create index idx_event_village on community_event (village_id);

//

drop table if exists event_comment;
//

create table event_comment
(
    id         int unsigned auto_increment,
    event_id   int unsigned NOT NULL,
    user_uuid  varchar(60)  NOT NULL,

    body       text         NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    constraint pk_event_comment primary key (id),

    constraint fk_comment_event foreign key (event_id) references community_event (id)
        on delete cascade,
    constraint fk_comment_author foreign key (user_uuid) references user (uuid)
        on delete cascade
);
//
drop table if exists conversation;
//

create table conversation
(
    id          int unsigned auto_increment,

    ad_id       int unsigned,
    -- Participantes, si un usuario se borra el chat no debe de desaparecer.
    buyer_uuid  varchar(60),
    seller_uuid varchar(60),

    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    constraint pk_conversation primary key (id),
    -- Solo un chat por anuncio y pareja de usuarios
    constraint uk_conversation_unique unique (ad_id, buyer_uuid, seller_uuid),

    constraint fk_conv_ad foreign key (ad_id) references service_ad (id)
        on delete set null,

    constraint fk_conv_buyer foreign key (buyer_uuid) references user (uuid)
        on delete set null
        on update cascade,

    constraint fk_conv_seller foreign key (seller_uuid) references user (uuid)
        on delete set null
        on update cascade
);
//

drop table if exists message;
//

create table message
(
    id              int unsigned auto_increment,

    conversation_id int unsigned NOT NULL,
    sender_uuid     varchar(60),

    content         text         NOT NULL,
    is_read         boolean   DEFAULT FALSE,
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    constraint pk_message primary key (id),

    constraint fk_msg_conversation foreign key (conversation_id) references conversation (id)
        on delete cascade,

    constraint fk_msg_sender foreign key (sender_uuid) references user (uuid)
        on delete set null
);
//