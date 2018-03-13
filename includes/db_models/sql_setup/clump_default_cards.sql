CREATE DATABASE  IF NOT EXISTS `clump` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `clump`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 138.68.52.24    Database: clump
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `character_card`
--

LOCK TABLES `character_card` WRITE;
/*!40000 ALTER TABLE `character_card` DISABLE KEYS */;
INSERT INTO `character_card` VALUES (1,1,NULL,'Professor','you may choose a major and a university resource.'),(2,1,NULL,'Police','make your debating with other players more persuasive.'),(3,1,NULL,'Salesperson','have extra time to express your opinion'),(4,1,NULL,'Terrorist','you must rob an equipment from someone, but it fails if police is in the round.'),(5,1,NULL,'Farmer','you may choose 1 uncooked farm item as your additional resource.'),(6,1,NULL,'Doctor','you may choose a drug as your additional resource.'),(7,1,NULL,'Fireman','your firetruck lets you ignore traffic lights'),(8,1,NULL,'Chef','you may cook up to 3 dishes as your additional resources.'),(9,1,NULL,'FBI agent','you can spy anyone who uses internet.'),(10,1,NULL,'Bill Gates','you may force Windows updates and money, like a ton of money.'),(11,1,NULL,'Judge\'s crush','someone who the judge can never get though'),(12,1,NULL,'Stage Magician','can make a single equipment card disappear'),(13,1,NULL,'Race Car Driver','choose any company as a sponsor'),(14,1,NULL,'Skydriver','you may fall towards a destination of your choice'),(15,1,NULL,'Backpacker','can carry two equipment cards'),(16,1,NULL,'Detective','you may go undercover as any other character in this round'),(17,1,NULL,'Secretary','you may overwhelm someone with appointments'),(18,1,NULL,'Singer','you may actually sing to the judge.'),(19,1,NULL,'Ninja','your clone is under the status, your real body is not.'),(20,1,NULL,'Pirate','the item you equipped is made of gold.'),(21,1,NULL,'Thief','the most valuable equipment in this round belongs to you now. '),(22,2,NULL,'Kermit',' what other people do is none of my business.'),(23,2,NULL,'Bad luck Brian',' you choose to lose this round, but change your winning points to the lowest non-zero value in this game.'),(24,2,NULL,'Philosoraptor',' you may ask judge a question.'),(25,2,NULL,'First world problem girl',' you may void your status in this round.'),(26,2,NULL,'Scumbag Steve',' you may swap your status with someone else.'),(27,2,NULL,'Forever Alone guy',' judge must ignore your argument this round.'),(28,2,NULL,'Good Guy Greg',' all other players shares your equipment.'),(29,2,NULL,'Social Penguin',' you must pretend the judge is someone else.'),(30,2,NULL,'Batman Slap Robin',' you may interrupt someone\'s argument and make it void.'),(31,2,NULL,'Overly Attached Girlfriend',' you must pretend the judge is your boy/girlfriend.'),(32,2,NULL,'Skeptical African Child',' you can be skeptical to others\' argument.'),(33,2,NULL,'Opinion Puffin',' the status you pick now becomes only your opinion.'),(34,2,NULL,'Roll Safe',' you don\'t need to argue with people, if you don\'t join this round.'),(35,2,NULL,'Back in my days grandpa',' your status happened in the pass.'),(36,2,NULL,'Picard facepalm',' when others are arguing, you must do facepalm.'),(37,2,NULL,'So I got that going with me',' you may say any status follow up to your status.'),(38,2,NULL,'Science Cat',' if you can make a science pun in your status, you may change your equipment to anything you want.'),(39,2,NULL,'That escalated quickly',' you must be the person who argue the first or the last.'),(40,2,NULL,'Good Advice Duck',' you can argue for other people, if they win the round you also win.'),(41,2,NULL,'Aint nobody got time for da',' everyone now only has 10 seconds to argue.');
/*!40000 ALTER TABLE `character_card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `equipment_card`
--

LOCK TABLES `equipment_card` WRITE;
/*!40000 ALTER TABLE `equipment_card` DISABLE KEYS */;
INSERT INTO `equipment_card` VALUES (1,1,NULL,'Chainsaw',''),(2,1,NULL,'Gun','specialized in shooting water.'),(3,1,NULL,'Lawn mower',''),(4,1,NULL,'Two dozen balloons',''),(5,1,NULL,'A needle that pops balloons',''),(6,1,NULL,'A pirate ship and crew',''),(7,1,NULL,'A home','Owns bank $500000'),(8,1,NULL,'TI-86 Graphing Calculator',''),(9,1,NULL,'Forklift',''),(10,1,NULL,'A box of chicken nuggets.','Choose your fastfood restaurant'),(11,1,NULL,'Cute dress',' you may specify the appearance of your cute dress.'),(12,1,NULL,'A brain transplant',' you may specify a brain function to be enhanced.'),(13,1,NULL,'iPhone 4S with iOS 5, you love the old technology.',''),(14,1,NULL,'Race car',' makes hot chicks love you.'),(15,1,NULL,'A number two pencil',''),(16,1,NULL,'A frying pan',''),(17,1,NULL,'37 rabid squirrels',''),(18,1,NULL,'A towel',''),(19,1,NULL,'99 problems but a bitch ain\'t one',''),(20,1,NULL,'A lid of a toilet tank',''),(21,1,NULL,'Baby blue hi top shoes',''),(22,1,NULL,'Computer',' choose an operating system.'),(23,1,NULL,'Watch',''),(24,1,NULL,'A bottle of water',''),(25,2,NULL,'Fidget spinner',' shape of your choice. If you actually have one with you now, you must spin it.'),(26,2,NULL,'Tide-Pod',' it looks so delicious, you wanna eat it.'),(27,2,NULL,'Nokia 3310',' the ultimate defence.'),(28,2,NULL,'Deal with it glasses',' if you win this round, you get one extra point.'),(29,2,NULL,'Tea-bag',' If you play as kermit, you get one extra point, if not, you may swap this equipment with someone\'s equipment.'),(30,2,NULL,'You are prepared to brace yourself','you get 1 point if this is the first round of the game.'),(31,2,NULL,'Italian passport',' you have to do the italian hand sign the entire round.'),(32,2,NULL,'Pen, Pineapple, Apple, Pen',' you can chain them together.'),(33,1,NULL,'Grenade','If you want to detonate it in your argument, you must pretend to throw it!');
/*!40000 ALTER TABLE `equipment_card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `status_card`
--

LOCK TABLES `status_card` WRITE;
/*!40000 ALTER TABLE `status_card` DISABLE KEYS */;
INSERT INTO `status_card` VALUES (1,1,NULL,'Just had morning coffee.'),(2,1,NULL,'Took a nap in a location of your choice .'),(3,1,NULL,'Smoking: something of your choice.'),(4,1,NULL,'Lost a leg in a poker game.'),(5,1,NULL,'Made out with Ashley Burker in the the third grade.'),(6,1,NULL,'Stepped in gum.'),(7,1,NULL,'Overslept the alarm.'),(8,1,NULL,'Talking on the phone.'),(9,1,NULL,'Caught in a riptide while swimming.'),(10,1,NULL,'Broke the sound barrier.'),(11,1,NULL,'Lost a bunch of money on the stock market.'),(12,1,NULL,'has 20 bitcoins in your digital wallet.'),(13,1,NULL,'Oh, chicken nuggets, you love chicken nuggets.'),(14,1,NULL,'Drunk and puke on a bus: needs to pay $100 clean up fee.'),(15,1,NULL,'Confessed to your crush via text 3 days ago, but she/he never reply.'),(16,1,NULL,'Said literally but meant figuratively .'),(17,1,NULL,'Got his/her hand stuck in a toaster and broke time and space.'),(18,1,NULL,'Stubbed his/her toe.'),(19,2,NULL,'Browsing 9GAG before sleeping'),(20,2,NULL,'Doing the tide pod challenge'),(21,2,NULL,'Liking your own post on Facebook'),(22,2,NULL,'The disaster girl just burn your house'),(23,2,NULL,'Your high expectation Asian Father is disappointing in your life choices'),(24,2,NULL,'Just got to the hot page with the meme you posted yesterday!'),(25,2,NULL,'Luck doge just visited you, you get 2 extra points if this is the last round of the game.'),(26,2,NULL,'You mom just hear you made a yo mama fat joke.'),(27,2,NULL,'The salt bae just made a steak for you!'),(28,2,NULL,'Bumped your head to a stop sign when playing pokemon go'),(29,2,NULL,'You are doing recycle because you love Earth-chan');
/*!40000 ALTER TABLE `status_card` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-13 16:54:28
