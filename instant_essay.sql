-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: instant_essay
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `essay_logs`
--

DROP TABLE IF EXISTS `essay_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `essay_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `topic` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `length` smallint(6) DEFAULT NULL,
  `response` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `narrative` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `essay_logs`
--

LOCK TABLES `essay_logs` WRITE;
/*!40000 ALTER TABLE `essay_logs` DISABLE KEYS */;
INSERT INTO `essay_logs` VALUES (1,2,'Trending in Artificial Intelligence',500,'\n\nArtificial Intelligence (AI) is one of the hottest topics in the tech world today. AI has been around for decades, but recently it has become a major area of focus for companies and organizations. AI can be applied to many aspects of life, from medical research to transport, and its potential applications are limitless. With the exponential growth of AI technology, it is no surprise that it is one of the biggest topics trending in the tech world today.\n\nOne of the most exciting aspects of AI is its potential to revolutionize the way we live and work. AI can be used to automate mundane tasks, improve decision-making processes, and even create new products and services that would not have been possible without its help. This can be seen in many industries, such as healthcare, where AI is being used to create diagnostics tools that can detect diseases earlier than ever before. In finance, AI is being used to create automated trading systems that can make decisions faster than any human could ever hope to. In transportation, self-driving cars are becoming more common thanks to advances in AI technology.\n\nThe potential applications of AI are vast and varied, but one area where it is particularly useful is in customer service. Companies are increasingly utilizing AI-powered chatbots to provide personalized customer service experiences. These chatbots can provide helpful advice on products and services, answer questions quickly and accurately, and provide personalized recommendations based on customer preferences and past purchases. As customer service becomes more automated, companies are able to provide better experiences for their customers while also saving money on staffing costs.\n\nAI technology also has huge implications for security. AI-driven security systems are being developed that can detect intrusions more quickly and accurately than traditional methods. These systems use machine learning algorithms to analyze data from multiple sources in order to detect anomalies or signs of malicious activity. This can help protect companies from cyber-attacks and reduce the risk of data breaches.\n\nFinally, one of the most exciting developments in AI is its potential use in robotics. Robotics has long been a fascination for scientists and engineers alike, but recent advances in AI technology have made it possible for robots to become smarter and more autonomous than ever before. Robotics can be used in a variety of ways, from manufacturing jobs to household chores; they promise a future where robots will be able to do a variety of tasks that were once thought impossible for machines to accomplish.\n\nAI is an incredibly exciting field with huge potential applications across many industries. From automating mundane tasks to providing personalized customer service experiences, AI has already transformed many aspects of our lives and there is no telling what advances it might bring about in the future. With so much potential for growth and development, it\'s no wonder that Artificial Intelligence is one of the biggest topics trending in the tech world today.','Active',NULL,'2023-02-22 12:19:42','2023-02-22 12:19:42'),(2,2,'Trending in Artificial Intelligence',50,'\n\nArtificial Intelligence (AI) has become one of the hottest topics in technology today. It is the power of machines to think and act like humans, and it is revolutionizing many industries. AI has the potential to automate processes and improve efficiency in many areas, such as healthcare, finance, transportation, and manufacturing. AI can also be used to create new products and services that are customized to people\'s individual needs. This can improve customer satisfaction and provide a competitive advantage for businesses. AI technologies are being used to develop more accurate diagnostics, develop smarter medical devices, reduce operational costs, and increase production output. In addition, AI is being used to create more efficient transportation systems and enhance security measures. AI is also being used to help us understand our environment better by providing insights into climate change and other environmental issues. AI is set to become even more pervasive in the near future, with applications ranging from autonomous vehicles to intelligent assistants. The possibilities for AI are limitless, and it will continue to be a trend that has significant impact on our lives.','Active',NULL,'2023-02-22 13:10:46','2023-02-22 13:10:46'),(3,2,'Trending in Artificial Intelligence',50,'\n\nArtificial Intelligence (AI) has become a hot topic in recent years, as it has become increasingly popular and widely used in many industries. AI is the ability of a computer or machine to mimic human cognition. It is used in areas such as robotics, natural language processing, facial recognition, and machine learning. AI can be used for a variety of tasks, from automating mundane tasks to making decisions that are more complex. AI is also being used to develop autonomous vehicles, improve healthcare systems, and transform the way businesses operate. AI has become so popular that it has become a major trend in many industries. Companies are investing heavily in developing AI technologies as they realize the potential of these technologies to improve their operations. AI is also being used in many consumer products, such as virtual assistants, voice-activated digital assistants, and smart home products. As AI continues to evolve, it will become an increasingly important part of everyday life.','Active',NULL,'2023-02-22 13:11:05','2023-02-22 13:11:05'),(4,2,'Trending in Artificial Intelligence',50,'\n\nArtificial Intelligence (AI) has become increasingly popular in recent years and is continuing to trend as technology advances. AI has the potential to revolutionize various industries by making it easier to automate mundane tasks and help businesses become more efficient. AI can also be used to enhance customer experience, improve safety, and reduce costs. For instance, AI can be used to automate customer service tasks, analyze customer data, and make predictions about future customer needs. Additionally, AI can be used to improve safety by detecting potential hazards before they become serious problems. Finally, AI can help reduce costs by reducing the amount of manual labor required for certain tasks. Overall, it is clear that AI is becoming increasingly popular and will continue to trend as technology progresses.','Active',NULL,'2023-02-22 13:11:22','2023-02-22 13:11:22');
/*!40000 ALTER TABLE `essay_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `provider_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provider_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_attended` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `about_us` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verification_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `for` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,NULL,NULL,'Root','root@instantessay.net','$2y$10$91OSxMlUV/Mh8duqqMoYb.APq47xyruUh4Ff81Ud9zSkYi.MILTqO',NULL,NULL,NULL,NULL,NULL,NULL,'Control Panel','Active','2021-04-11 11:55:46','2021-04-11 11:55:46'),(2,NULL,NULL,'Colby','colby@instantessay.net','$2y$10$91OSxMlUV/Mh8duqqMoYb.APq47xyruUh4Ff81Ud9zSkYi.MILTqO',NULL,NULL,NULL,NULL,NULL,NULL,'Account Panel','Active','2022-11-16 14:17:08','2022-11-16 14:33:36'),(3,NULL,NULL,'Asraf','seaudbd@gmail.com','$2y$10$tRPQYO8Kklgv9zXiu3bV8OmD0FNhV9z.ILv8rKXgp2D.OlLTKYZOG','Graduate School','Online',NULL,NULL,NULL,NULL,'Account Panel','Active','2023-02-22 16:31:14','2023-02-22 16:31:14'),(4,NULL,NULL,'Logz','dlogzn@gmail.com','$2y$10$pQDjWIQGPEwxDFdfBJQoC.TFZADp9Fau4c0nZy406g2oKr0wuTM32','Dhaka','Online',NULL,NULL,NULL,NULL,'Account Panel','Active','2023-02-22 16:36:15','2023-02-22 16:36:15');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-02-23  4:37:16
