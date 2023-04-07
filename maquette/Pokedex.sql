CREATE TABLE `Pokemon` (
  `id` integer PRIMARY KEY,
  `name` varchar(255,not null),
  `image` varchar(255,not null),
  `number` Integer(not null),
  `type1` int(foreign key, not null),
  `type2` Integer(foreign key, null),
  `description` text(not null),
  `height` float(not null),
  `weight` float(not null),
  `hp` integer(not null),
  `atk` integer(not null),
  `def` integer(not null),
  `atkspe` integer(not null),
  `defspe` integer(not null)
);

CREATE TABLE `Type` (
  `id` integer PRIMARY KEY,
  `name` varchar(255 , not null)
);

ALTER TABLE `Pokemon` ADD FOREIGN KEY (`type1`) REFERENCES `Type` (`id`);

ALTER TABLE `Pokemon` ADD FOREIGN KEY (`type2`) REFERENCES `Type` (`id`);
