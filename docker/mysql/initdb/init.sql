CREATE TABLE `posts`
(
    `id`             varchar(26)  NOT NULL,
    `from_name`      varchar(200) NOT NULL,
    `from_id`        varchar(200) NOT NULL,
    `message`        text         NOT NULL,
    `message_length` int          NOT NULL,
    `type`           varchar(20)  NOT NULL,
    `created_time`   datetime     NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

ALTER TABLE `posts`
    ADD PRIMARY KEY (`id`);
