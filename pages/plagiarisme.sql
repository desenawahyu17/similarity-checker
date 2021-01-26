﻿# Host: localhost  (Version 5.5.5-10.1.19-MariaDB)
# Date: 2021-01-14 00:18:25
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "document"
#

DROP TABLE IF EXISTS `document`;
CREATE TABLE `document` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nim` char(10) DEFAULT NULL,
  `uploaddate` datetime DEFAULT NULL,
  `file_size` varchar(7) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Data for table "document"
#


#
# Structure for table "plagiarisme"
#

DROP TABLE IF EXISTS `plagiarisme`;
CREATE TABLE `plagiarisme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `scandate` datetime DEFAULT NULL,
  `file_size` varchar(7) DEFAULT NULL,
  `similarity` double DEFAULT NULL,
  `content` text,
  `content_clean` text,
  `ngram` text,
  `hash` text,
  `window` text,
  `fingerprint` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Data for table "plagiarisme"
#


#
# Structure for table "preprocessing"
#

DROP TABLE IF EXISTS `preprocessing`;
CREATE TABLE `preprocessing` (
  `id` int(11) NOT NULL,
  `nim` char(10) DEFAULT NULL,
  `uploaddate` datetime DEFAULT NULL,
  `file_size` varchar(7) DEFAULT NULL,
  `content` text,
  `ngram` text,
  `hash` text,
  `window` text,
  `fingerprint` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "preprocessing"
#


#
# Structure for table "slangword"
#

DROP TABLE IF EXISTS `slangword`;
CREATE TABLE `slangword` (
  `id_slangword` int(11) NOT NULL AUTO_INCREMENT,
  `slangword` varchar(255) DEFAULT NULL,
  `kata_asli` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_slangword`)
) ENGINE=InnoDB AUTO_INCREMENT=480 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "slangword"
#

INSERT INTO `slangword` VALUES (1,'aberasi','abrasi'),(2,'nuhun','maaf'),(3,'accu','aki'),(4,'adap','adab'),(5,'adiguna','adiguna'),(6,'admin','administrator'),(7,'adpokat','advokat'),(8,'adzan','azan'),(9,'afdol','afdal'),(10,'agamis','agamais'),(11,'ajektif','adjektif'),(12,'ajimat','azimat'),(13,'akhirulkalam','akhirulkalam'),(14,'aktuil','aktual'),(15,'amandemen','amendemen'),(16,'ambeyen','ambeien'),(17,'ambulan','ambulans'),(18,'ambulance','ambulans'),(19,'analisa','analisis'),(20,'anestesia','anestesi'),(21,'ansambel','ensambel'),(22,'antarumatberagama','antarumatberagama'),(23,'antene','antenna'),(24,'antri','antre'),(25,'aparatur','aparat'),(26,'aplus','aplaus'),(27,'apotik','apotek'),(28,'aquades','akuades'),(29,'asal-muasal','asal mula'),(30,'asesori','aksesori'),(31,'astronot','astronaut'),(32,'atheis','ateis'),(33,'atmosfir','atmosfer'),(34,'audiens','audiensi'),(35,'autobiografi','otobiografi'),(36,'automatis','otomatis'),(37,'automatic','otomatis'),(38,'azas','asas'),(39,'balsem','balsam'),(40,'bangker','bungker'),(41,'baqa','baka'),(42,'barzah','alamkubur'),(43,'batalyon','batalion'),(44,'baterei','baterai'),(45,'bathil','batil'),(46,'bazaar','bazar'),(47,'belangko','blangko'),(48,'belender','blender'),(49,'bengkoang','bengkuang'),(50,'bengkowang','bengkuang'),(51,'bhiku','biksu'),(52,'bis','bus'),(53,'blokir','blockade'),(54,'bolpoint','bolpoin'),(55,'bolpen','bolpoin'),(56,'polpen','bolpoin'),(57,'bongkok','bungkuk'),(58,'brandal','berandal'),(59,'brangkas','brankas'),(60,'brengsek','berengsek'),(61,'brewok','bewok'),(62,'budeg','budek'),(63,'budget','bujet'),(64,'cabe','cabai'),(65,'cafetaria','kafetaria'),(66,'cape','capai'),(67,'capek','capai'),(68,'cengkeh','cengkih'),(69,'cengkram','cengkeram'),(70,'cengkrama','bersenang-senang'),(71,'cengkerama','bersenang-senang'),(72,'cidera','cedera'),(73,'cinderamata','cenderamata'),(74,'clien','klien'),(75,'clurit','celurit'),(76,'cockpit','kokpit'),(77,'coklat','cokelat'),(78,'combro','comro'),(79,'debet','debit'),(80,'debitur','debitor'),(81,'defiasi','deviasi'),(82,'dekrit','dekret'),(83,'deodorant','deodorant'),(84,'depo','depot'),(85,'deputy','deputi'),(86,'design','desain'),(87,'disain','desain'),(88,'despenser','dispenser'),(89,'destilasi','distilasi'),(90,'deterjen','detergen'),(91,'detil','detail'),(92,'detel','detail'),(93,'deviden','dividen'),(94,'dharma','darma'),(95,'diagnosa','diagnosis'),(96,'diagnose','diagnosis'),(97,'disco','disko'),(98,'diskotik','diskotek'),(99,'diskripsi','deskripsi'),(100,'dollar','dolar'),(101,'domain','domein'),(102,'dramatisir','dramatisasi'),(103,'duren','durian'),(104,'dzat','zat'),(105,'dzikir','zikir'),(106,'faham','paham'),(107,'faksinasi','vaksinasi'),(108,'fakum','vakum'),(109,'vacuum','vakum'),(110,'falid','valid'),(111,'faqih','fakih'),(112,'fas','vas'),(113,'ferri','feri'),(114,'fery','feri'),(115,'filsof','filosof'),(116,'filsuf','filosof'),(117,'finish','finis'),(118,'foklor','folklore'),(119,'formil','formal'),(120,'foto copy','fotokopi'),(121,'foto kopi','fotokopi'),(122,'photo copy','fotokopi'),(123,'foto studio','studio foto'),(124,'fotosintesa','fotosintesis'),(125,'frasa','frase'),(126,'frekwensi','frekuensi'),(127,'fron','front'),(128,'frustasi','frustrasi'),(129,'galleri','galeri'),(130,'gallery','galeri'),(131,'geladiresik','geladi bersih'),(132,'gladibersih','geladi bersih'),(133,'genius','jenius'),(134,'genteng','genting'),(135,'gep','gap'),(136,'gepok','kapok'),(137,'ghaib','gaib'),(138,'ghoib','gaib'),(139,'gladi','geladi'),(140,'glamour','glamor'),(141,'glondong','gelondong'),(142,'glosary','glosarium'),(143,'goa','gua'),(144,'goncang','guncang'),(145,'greget','gereget'),(146,'grendel','gerendel'),(147,'griya','gria'),(148,'grogol','gerogol'),(149,'gudeg','gudek'),(150,'hakekat','hakikat'),(151,'handal','andal'),(152,'hapal','hafal'),(153,'hektar','hektare'),(154,'hempas','empas'),(155,'hetrogen','heterogen'),(156,'higiena','higienis'),(157,'hygiene','higienis'),(158,'himbau','imbau'),(159,'himpit','impit'),(160,'hingar-bingar','ingar-bingar'),(161,'hipotesa','hipotesis'),(162,'hipotik','hipotek'),(163,'hirarki','hierarki'),(164,'hisap','isap'),(165,'hutang','utang'),(166,'hybrida','hibrida'),(167,'hymne','himne'),(168,'i’tikaf','iktikaf'),(169,'idiil','ideal'),(170,'idial','ideal'),(171,'idiologi','ideologi'),(172,'ijasah','ijazah'),(173,'ijin','izin'),(174,'ikhwal','ihwal'),(175,'iklas','ikhlas'),(176,'ihlas','ikhlas'),(177,'illusi','ilusi'),(178,'import','impor'),(179,'income','pendapatan'),(180,'influensa','influenza'),(181,'influenza','influenza'),(182,'infra merah','inframerah'),(183,'inpus','infus'),(184,'insyaf','insaf'),(185,'intel','intelijen'),(186,'inteligen','intelijen'),(187,'intelejensi','intelegensi'),(188,'inten','intens'),(189,'interest','interes'),(190,'intermezo','intermeso'),(191,'interograsi','interogasi'),(192,'interospeksi','introspeksi'),(193,'interprestasi','interpretasi'),(194,'intrupsi','interupsi'),(195,'islamiyah','islamiah'),(196,'isteri','istri'),(197,'istighfar','istigfar'),(198,'jagad','jagat'),(199,'jahiliyah','jahiliah'),(200,'jaman','zaman'),(201,'jejer','jajar'),(202,'jemaah','jamaah'),(203,'jemaat','jamaah'),(204,'jenasah','jenazah'),(205,'jendral','jenderal'),(206,'jenius','genius'),(207,'jerembap','jerembab'),(208,'jogging','jogging'),(209,'joint','join'),(210,'kacamata','kacamata'),(211,'kadaluwarsa','kedaluwarsa'),(212,'kaedah','kaidah'),(213,'kakatua','kakaktua'),(214,'kaleidioskop','kaleidoskop'),(215,'kameramen','kamerawan'),(216,'kameraman','kamerawan'),(217,'kamuplase','kamuflase'),(218,'kangker','kanker'),(219,'kantung','kantong'),(220,'kaos','kaus'),(221,'katagori','kategori'),(222,'katalisa','katalisis'),(223,'katring','catering'),(224,'cathering','catering'),(225,'keburu','terburuk'),(226,'kdlmn','kedalaman'),(227,'kedele','kedelai'),(228,'kelep','klep'),(229,'kemana','kemana'),(230,'kenalpot','knalpot'),(231,'kendor','kendur'),(232,'kenop','knop'),(233,'kerdip','kedip'),(234,'kerdus','kardus'),(235,'kerjasama','kerjasama'),(236,'ketawa','tertawa'),(237,'ketemu','bertemu'),(238,'kharisma','karisma'),(239,'klorofil','kloropil'),(240,'kloter','keloter'),(241,'koboy','koboi'),(242,'kocar-kacir','kucar-kacir'),(243,'komersil','komersial'),(244,'komfirmasi','konfirmasi'),(245,'komoditi','komoditas'),(246,'konggres','kongres'),(247,'kongkret','konkret'),(248,'kongkrit','konkret'),(249,'konkrit','konkret'),(250,'konsleting','korsleting'),(251,'kram','keram'),(252,'kramat','keramat'),(253,'kreatifitas','kreativitas'),(254,'kresek','keresek'),(255,'kwitansi','kuitansi'),(256,'kwitangsi','kuitansi'),(257,'lajim','lazim'),(258,'lasim','lazim'),(259,'lapal','lafal'),(260,'rapal','lafal'),(261,'lasykar','laskar'),(262,'legalisir','legalisasi'),(263,'lemari','almari'),(264,'lembap','lembab'),(265,'leukimia','leukemia'),(266,'limpha','limfa'),(267,'limpa','limfa'),(268,'linier','linear'),(269,'lobang','lubang'),(270,'lokalisir','lokalisasi'),(271,'losin','lusin'),(272,'dozen','lusin'),(273,'dosin','lusin'),(274,'lotere','lotre'),(275,'ma’af','maaf'),(276,'mabok','mabuk'),(277,'maag','mag'),(278,'mahnet','magnet'),(279,'mahaesa','mahaesa'),(280,'maha esa','mahaesa'),(281,'mahakuasa','mahakuasa'),(282,'maha kuasa','mahakuasa'),(283,'maha pengasih','mahapengasih'),(284,'mahapengasih','mahapengasih'),(285,'makroekonomi','makroekonomi'),(286,'mampet','mampat'),(287,'manager','manajer'),(288,'mangkok','mangkuk'),(289,'mantera','mantra'),(290,'marathon','marathon'),(291,'margarine','margarin'),(292,'massal','masal'),(293,'mentari','matahari'),(294,'melody','melodi'),(295,'menyuci','mencuci'),(296,'menterapkan','menerapkan'),(297,'meram','merem'),(298,'metoda','metode'),(299,'mie','mi'),(300,'moto','motto'),(301,'musyafir','musafir'),(302,'nafas','napas'),(303,'nahas','naas'),(304,'nahkoda','nakhoda'),(305,'nakoda','nakhoda'),(306,'nasehat','nasihat'),(307,'netralisir','netralisasi'),(308,'netto','neto'),(309,'notulen','notula'),(310,'omset','omzet'),(311,'ongseng','gongseng'),(312,'oseng-oseng','gongseng'),(313,'organisir','organisasi'),(314,'orisinil','orisinal'),(315,'orkhestra','orkestra'),(316,'orchestra','orkestra'),(317,'otentik','autentik'),(318,'otopsi','autopsi'),(319,'palem','palma'),(320,'pamfelet','pamflet'),(321,'famplet','pamflet'),(322,'pancaindra','pancaindera'),(323,'pangkreas','pankreas'),(324,'panitra','panitera'),(325,'pas foto','pasfoto'),(326,'pas photo','pasfoto'),(327,'pasca-panen','pascapanen'),(328,'pasport','paspor'),(329,'pavilyun','anjungan'),(330,'paviliyun','anjugan'),(331,'pebruari','februari'),(332,'pedes','pedas'),(333,'pelaminan','pelamin'),(334,'pengrajin','perajin'),(335,'perduli','peduli'),(336,'photo','foto'),(337,'piranti','peranti'),(338,'pirsawan','pemirsa'),(339,'plesir','pelesir'),(340,'plonco','pelonco'),(341,'plontos','pelontos'),(342,'qolam','kalam'),(343,'qalam','kalam'),(344,'qolbu','kalbu'),(345,'qomat','kamat'),(346,'quraisy','kuraisy'),(347,'ramadhan','ramadan'),(348,'romadhon','ramadan'),(349,'romadlon','ramadan'),(350,'rangking','ranking'),(351,'rengking','ranking'),(352,'ranzel','ransel'),(353,'rangsel','ransel'),(354,'rapih','rapi'),(355,'rapot','rapor'),(356,'raport','rapor'),(357,'rasia','razia'),(358,'rajia','razia'),(359,'rasialist','rasialis'),(360,'rasionil','rasional'),(361,'rebo','rabu'),(362,'rejeki','rezeki'),(363,'rezki','rezeki'),(364,'rizqi','rezeki'),(365,'rekruit','rekrut'),(366,'relif','relief'),(367,'reptil','reptilia'),(368,'resiko','risiko'),(369,'respon','respons'),(370,'restauran','restoran'),(371,'restaurant','restoran'),(372,'resum','resume'),(373,'reumatik','rematik'),(374,'riil','nyata'),(375,'ritme','ritma'),(376,'roh','ruh'),(377,'ronsen','rontgen'),(378,'route','rute'),(379,'rubah','ubah'),(380,'sahadat','syahadat'),(381,'sahid','syahid'),(382,'syahit','syahid'),(383,'sahwat','syahwat'),(384,'saklar','sakelar'),(385,'sambel','sambal'),(386,'sangsi','sanksi'),(387,'sanjak','sajak'),(388,'sansekerta','sanskerta'),(389,'saos','saus'),(390,'saparila','sarsaparilla'),(391,'saplemen','suplemen'),(392,'supplement','suplemen'),(393,'sate','satai'),(394,'sekedar','sekadar'),(395,'seksama','saksama'),(396,'sekuler','secular'),(397,'sentausa','sentosa'),(398,'sepanduk','spanduk'),(399,'sepesial','spesial'),(400,'special','spesial'),(401,'seprei','seprai'),(402,'stress','stres'),(403,'strip','setrip'),(404,'strok','stroke'),(405,'subsidair','subside'),(406,'subtansi','substansi'),(407,'subtitusi','substitusi'),(408,'subyek','subjek'),(409,'sukacita','sukacita'),(410,'sup','sop'),(411,'soup','sop'),(412,'supir','sopir'),(413,'surve','survei'),(414,'survey','survei'),(415,'sutra','sutera'),(416,'syahdu','sahdu'),(417,'syurga','surga'),(418,'sorga','surga'),(419,'tahta','takhta'),(420,'tangker','tanker'),(421,'tape','tapai'),(422,'tapi','tetapi'),(423,'tatto','tato'),(424,'taubat','tobat'),(425,'taulada/toladan','teladan'),(426,'taxi','taksi'),(427,'tehnik','teknik'),(428,'tekat','tekad'),(429,'telor','telur'),(430,'tentram','tenteram'),(431,'terimakasih','terimakasih'),(432,'terlantar','telantar'),(433,'test','tes'),(434,'theater','teater'),(435,'theologi','teologi'),(436,'thesis','tesis'),(437,'ticket','tiket'),(438,'timun','mentimun'),(439,'ketimun','mentimun'),(440,'tips','tip'),(441,'tolerir','toleransi'),(442,'toples','stoples'),(443,'tour','tur'),(444,'touris','turis'),(445,'tournamen','turnamen'),(446,'tournament','turnamen'),(447,'tradisionil','tradisional'),(448,'trophi','piala'),(449,'tropi','piala'),(450,'type','tipe'),(451,'ujianulangan','ujian ulang'),(452,'ultra modern','ultramodern'),(453,'urin','urine'),(454,'ustadz','ustaz'),(455,'valentin','valentine'),(456,'vampire','vampir'),(457,'varitas','varietas'),(458,'vegetarian','vegetaris'),(459,'vermaks','vermak'),(460,'vignet','vinyet'),(461,'villa','vila'),(462,'yudikatif','judikatif'),(463,'yudisial','judisial'),(464,'yudo','judo'),(465,'yunior','junior'),(466,'yurisdiksi','jurisdiksi'),(467,'zahir','lahir'),(468,'zohir','lahir'),(469,'dhohir','lahir'),(470,'zam-zam','zamzam'),(471,'zig-zag','zigzag'),(472,'zinah','zina'),(473,'jina','zina'),(474,'zygot','zigot'),(475,'zygote','zigot'),(477,'na ve','naive'),(478,'naÃ¯ve','naive'),(479,'system','sistem');

#
# Structure for table "stopword"
#

DROP TABLE IF EXISTS `stopword`;
CREATE TABLE `stopword` (
  `id_stopword` int(11) NOT NULL AUTO_INCREMENT,
  `stopword` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_stopword`)
) ENGINE=InnoDB AUTO_INCREMENT=1337 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

#
# Data for table "stopword"
#

INSERT INTO `stopword` VALUES (1,'a'),(2,'abad'),(3,'acara'),(4,'aceh'),(5,'ada'),(6,'adalah'),(7,'adanya'),(8,'adapun'),(9,'agak'),(10,'agaknya'),(11,'agama'),(12,'agar'),(13,'agustus'),(14,'air'),(15,'akan'),(16,'akankah'),(17,'akhir'),(18,'akhiri'),(19,'akhirnya'),(20,'akibat'),(21,'aku'),(22,'akulah'),(23,'alam'),(24,'album'),(25,'amat'),(26,'amatlah'),(27,'amerika'),(28,'anak'),(29,'and'),(30,'anda'),(31,'andalah'),(32,'anggota'),(33,'antar'),(34,'antara'),(35,'antarabangsa'),(36,'antaranya'),(37,'apa'),(38,'apaan'),(39,'apabila'),(40,'apakah'),(41,'apalagi'),(42,'apatah'),(43,'api'),(44,'april'),(45,'artikel'),(46,'artinya'),(47,'as'),(48,'asal'),(49,'asalkan'),(50,'asas'),(51,'asia'),(52,'asing'),(53,'atas'),(54,'atau'),(55,'ataukah'),(56,'ataupun'),(57,'australia'),(58,'awal'),(59,'awalnya'),(60,'awam'),(61,'b'),(62,'badan'),(63,'bagai'),(64,'bagaikan'),(65,'bagaimana'),(66,'bagaimanakah'),(67,'bagaimanapun'),(68,'bagainamakah'),(69,'bagi'),(70,'bagian'),(71,'bahagian'),(72,'bahan'),(73,'baharu'),(74,'bahasa'),(75,'bahawa'),(76,'bahkan'),(77,'bahwa'),(78,'bahwasannya'),(79,'bahwasanya'),(80,'baik'),(81,'baiknya'),(82,'bakal'),(83,'bakalan'),(84,'balik'),(85,'bandar'),(86,'bangsa'),(87,'bank'),(88,'banyak'),(89,'bapak'),(90,'barang'),(91,'barangan'),(93,'baru'),(94,'baru-baru'),(95,'bawah'),(96,'beberapa'),(97,'begini'),(98,'beginian'),(99,'beginikah'),(100,'beginilah'),(101,'begitu'),(102,'begitukah'),(103,'begitulah'),(104,'begitupun'),(105,'bekas'),(106,'bekerja'),(107,'belakang'),(108,'belakangan'),(109,'belanda'),(110,'beli'),(111,'beliau'),(112,'belum'),(113,'belumlah'),(114,'benar'),(115,'benarkah'),(116,'benarlah'),(117,'bentuk'),(118,'berada'),(119,'berakhir'),(120,'berakhirlah'),(121,'berakhirnya'),(122,'berapa'),(123,'berapakah'),(124,'berapalah'),(125,'berapapun'),(126,'berarti'),(127,'berasal'),(128,'berat'),(129,'berawal'),(130,'berbagai'),(131,'berbanding'),(132,'berbeda'),(133,'berdasarkan'),(134,'berdatangan'),(135,'berharap'),(136,'berhasil'),(137,'beri'),(138,'berikan'),(139,'berikut'),(140,'berikutan'),(141,'berikutnya'),(142,'berita'),(143,'berjalan'),(144,'berjaya'),(145,'berjumlah'),(146,'berkaitan'),(147,'berkali'),(148,'berkali-kali'),(149,'berkata'),(150,'berkehendak'),(151,'berkeinginan'),(152,'berkenaan'),(153,'berlainan'),(154,'berlaku'),(155,'berlalu'),(156,'berlangsung'),(157,'berlebihan'),(158,'bermacam'),(159,'bermacam-macam'),(160,'bermain'),(161,'bermaksud'),(162,'bermula'),(163,'bernama'),(164,'bernilai'),(165,'bersama'),(166,'bersama-sama'),(167,'bersiap'),(168,'bertanya'),(169,'bertemu'),(170,'berturut'),(171,'bertutur'),(172,'berubah'),(173,'berujar'),(174,'berupa'),(175,'besar'),(176,'besok'),(177,'betul'),(178,'betulkah'),(179,'bhd'),(180,'biasa'),(181,'biasanya'),(182,'bidang'),(183,'bila'),(184,'bilakah'),(185,'bilion'),(186,'bintang'),(187,'bisa'),(188,'bisakah'),(189,'blog'),(190,'bn'),(191,'bola'),(192,'boleh'),(193,'bolehkah'),(194,'bolehlah'),(195,'buat'),(196,'bukan'),(197,'bukankah'),(198,'bukanlah'),(199,'bukannya'),(200,'buku'),(201,'bulan'),(202,'bumi'),(203,'bung'),(204,'bursa'),(205,'cadangan'),(206,'cara'),(207,'caranya'),(208,'catch'),(209,'china'),(210,'click'),(211,'code'),(212,'copyright'),(213,'cukup'),(214,'cukupkah'),(215,'cukuplah'),(216,'cuma'),(217,'daerah'),(218,'dagangan'),(219,'dahulu'),(220,'dalam'),(221,'dan'),(222,'dana'),(223,'dapat'),(224,'dari'),(225,'daripada'),(226,'dasar'),(228,'datang'),(229,'datuk'),(230,'dekat'),(231,'demi'),(232,'demikian'),(233,'demikianlah'),(234,'dengan'),(235,'depan'),(236,'derivatives'),(237,'desa'),(238,'desember'),(239,'detik'),(240,'dewan'),(241,'di'),(242,'dia'),(243,'diadakan'),(244,'diakhiri'),(245,'diakhirinya'),(246,'dialah'),(247,'dianggap'),(248,'diantara'),(249,'diantaranya'),(250,'diberi'),(251,'diberikan'),(252,'diberikannya'),(253,'dibuat'),(254,'dibuatnya'),(255,'dibuka'),(256,'dicatatkan'),(257,'didapat'),(258,'didatangkan'),(259,'didirikan'),(260,'diduga'),(261,'digunakan'),(262,'diibaratkan'),(263,'diibaratkannya'),(264,'diingat'),(265,'diingatkan'),(266,'diinginkan'),(267,'dijangka'),(268,'dijawab'),(269,'dijelaskan'),(270,'dijelaskannya'),(271,'dikarenakan'),(272,'dikatakan'),(273,'dikatakannya'),(274,'dikenal'),(275,'dikerjakan'),(276,'diketahui'),(277,'diketahuinya'),(278,'dikira'),(279,'dilakukan'),(280,'dilalui'),(281,'dilihat'),(282,'dimaksud'),(283,'dimaksudkan'),(284,'dimaksudkannya'),(285,'dimaksudnya'),(286,'dimana'),(287,'diminta'),(288,'dimintai'),(289,'dimisalkan'),(290,'dimulai'),(291,'dimulailah'),(292,'dimulainya'),(293,'dimungkinkan'),(294,'dini'),(295,'diniagakan'),(296,'dipastikan'),(297,'diperbuat'),(298,'diperbuatnya'),(299,'dipergunakan'),(300,'diperkirakan'),(301,'diperlihatkan'),(302,'diperlukan'),(303,'diperlukannya'),(304,'dipersoalkan'),(305,'dipertanyakan'),(306,'dipunyai'),(307,'diri'),(308,'dirilis'),(309,'dirinya'),(310,'dis'),(311,'disampaikan'),(312,'disebut'),(313,'disebutkan'),(314,'disebutkannya'),(315,'disember'),(316,'disini'),(317,'disinilah'),(318,'distrik'),(319,'ditambahkan'),(320,'ditandaskan'),(321,'ditanya'),(322,'ditanyai'),(323,'ditanyakan'),(324,'ditegaskan'),(325,'ditemukan'),(326,'ditujukan'),(327,'ditunjuk'),(328,'ditunjuki'),(329,'ditunjukkan'),(330,'ditunjukkannya'),(331,'ditunjuknya'),(332,'ditutup'),(333,'dituturkan'),(334,'dituturkannya'),(335,'diucapkan'),(336,'diucapkannya'),(337,'diungkapkan'),(338,'document.write'),(339,'dolar'),(340,'dong'),(341,'dr'),(342,'dua'),(343,'dulu'),(344,'dunia'),(345,'effective'),(346,'ekonomi'),(347,'eksekutif'),(348,'eksport'),(349,'empat'),(350,'enam'),(351,'enggak'),(352,'enggaknya'),(353,'entah'),(354,'entahlah'),(355,'era'),(356,'eropa'),(357,'err'),(358,'faedah'),(359,'feb'),(360,'film'),(361,'gat'),(362,'gedung'),(363,'gelar'),(364,'gettracker'),(365,'global'),(366,'grup'),(367,'guna'),(368,'gunakan'),(369,'gunung'),(370,'hadap'),(371,'hadapan'),(372,'hal'),(373,'hampir'),(374,'hanya'),(375,'hanyalah'),(376,'harga'),(377,'hari'),(378,'harian'),(379,'harus'),(380,'haruslah'),(381,'harusnya'),(382,'hasil'),(383,'hendak'),(384,'hendaklah'),(385,'hendaknya'),(386,'hidup'),(387,'hingga'),(388,'https'),(389,'hubungan'),(390,'hukum'),(391,'hutan'),(392,'i'),(393,'ia'),(394,'iaitu'),(395,'ialah'),(396,'ibarat'),(397,'ibaratkan'),(398,'ibaratnya'),(399,'ibu'),(400,'ii'),(401,'iklan'),(402,'ikut'),(403,'ilmu'),(404,'indeks'),(405,'india'),(406,'indonesia'),(407,'industri'),(408,'informasi'),(409,'ingat'),(410,'inggris'),(411,'ingin'),(412,'inginkah'),(413,'inginkan'),(414,'ini'),(415,'inikah'),(416,'inilah'),(417,'internasional'),(418,'islam'),(419,'isnin'),(420,'isu'),(421,'italia'),(422,'itu'),(423,'itukah'),(424,'itulah'),(425,'jabatan'),(426,'jadi'),(427,'jadilah'),(428,'jadinya'),(429,'jakarta'),(430,'jalan'),(431,'jalur'),(432,'jaman'),(433,'jan'),(434,'jangan'),(435,'jangankan'),(436,'janganlah'),(437,'januari'),(438,'jauh'),(439,'jawa'),(440,'jawab'),(441,'jawaban'),(442,'jawabnya'),(443,'jawatan'),(444,'jawatankuasa'),(445,'jelas'),(446,'jelaskan'),(447,'jelaslah'),(448,'jelasnya'),(449,'jenis'),(450,'jepang'),(451,'jepun'),(452,'jerman'),(453,'jika'),(454,'jikalau'),(455,'jiwa'),(456,'jual'),(457,'jualan'),(458,'juga'),(459,'julai'),(460,'jumaat'),(461,'jumat'),(462,'jumlah'),(463,'jumlahnya'),(464,'jun'),(465,'juni'),(466,'justru'),(467,'juta'),(468,'kabar'),(469,'kabupaten'),(470,'kadar'),(471,'kala'),(472,'kalangan'),(473,'kalau'),(474,'kalaulah'),(475,'kalaupun'),(476,'kali'),(477,'kalian'),(478,'kalimantan'),(479,'kami'),(480,'kamilah'),(481,'kamis'),(482,'kamu'),(483,'kamulah'),(484,'kan'),(485,'kantor'),(486,'kapal'),(487,'kapan'),(488,'kapankah'),(489,'kapanpun'),(490,'karena'),(491,'karenanya'),(492,'karya'),(493,'kasus'),(495,'katakan'),(496,'katakanlah'),(497,'katanya'),(498,'kaunter'),(499,'kawasan'),(500,'ke'),(501,'keadaan'),(502,'kebetulan'),(503,'kebutuhan'),(504,'kecamatan'),(505,'kecil'),(506,'kedua'),(507,'kedua-dua'),(508,'keduanya'),(509,'kedudukan'),(510,'kegiatan'),(511,'kehidupan'),(512,'keinginan'),(513,'kejadian'),(514,'kekal'),(515,'kelamaan'),(516,'kelihatan'),(517,'kelihatannya'),(518,'kelima'),(519,'kelompok'),(520,'keluar'),(521,'keluarga'),(522,'kelurahan'),(523,'kembali'),(524,'kementerian'),(525,'kemudahan'),(526,'kemudian'),(527,'kemungkinan'),(528,'kemungkinannya'),(529,'kenaikan'),(530,'kenapa'),(531,'kenyataan'),(532,'kepada'),(533,'kepadanya'),(534,'kepala'),(535,'kepentingan'),(536,'keputusan'),(537,'kerajaan'),(538,'kerana'),(539,'kereta'),(540,'kerja'),(541,'kerjasama'),(542,'kes'),(543,'kesampaian'),(544,'keselamatan'),(545,'keseluruhan'),(546,'keseluruhannya'),(547,'kesempatan'),(548,'kesihatan'),(549,'keterangan'),(550,'keterlaluan'),(551,'ketiga'),(552,'ketika'),(553,'ketua'),(554,'keuntungan'),(555,'kewangan'),(556,'khamis'),(557,'khusus'),(558,'khususnya'),(559,'kini'),(560,'kinilah'),(561,'kira'),(562,'kira-kira'),(563,'kiranya'),(564,'kita'),(565,'kitalah'),(566,'klci'),(567,'klibor'),(568,'klik'),(569,'km'),(570,'kok'),(571,'komentar'),(572,'kompas'),(573,'komposit'),(574,'kondisi'),(575,'kontrak'),(576,'korban'),(577,'korea'),(578,'kos'),(579,'kota'),(580,'kuala'),(581,'kuasa'),(582,'kukuh'),(583,'kumpulan'),(584,'kurang'),(585,'kurangnya'),(586,'lagi'),(587,'lagian'),(588,'lagu'),(589,'lah'),(590,'lain'),(591,'lainnya'),(592,'laku'),(593,'lalu'),(594,'lama'),(595,'lamanya'),(596,'langkah'),(597,'langsung'),(598,'lanjut'),(599,'lanjutnya'),(600,'laporan'),(601,'laut'),(602,'lebih'),(603,'lembaga'),(604,'lepas'),(605,'lewat'),(606,'lima'),(607,'lingkungan'),(608,'login'),(609,'lokasi'),(610,'lot'),(611,'luar'),(612,'luas'),(613,'lumpur'),(614,'mac'),(615,'macam'),(616,'mahkamah'),(617,'mahu'),(618,'majlis'),(619,'maka'),(620,'makanan'),(621,'makanya'),(622,'makin'),(623,'maklumat'),(624,'malah'),(625,'malahan'),(626,'malam'),(627,'malaysia'),(628,'mampu'),(629,'mampukah'),(630,'mana'),(631,'manakala'),(632,'manalagi'),(633,'mantan'),(634,'manusia'),(635,'masa'),(636,'masalah'),(637,'masalahnya'),(638,'masih'),(639,'masihkah'),(640,'masing'),(641,'masing-masing'),(642,'masuk'),(643,'masyarakat'),(644,'mata'),(645,'mau'),(646,'maupun'),(647,'measure'),(648,'media'),(649,'mei'),(650,'melainkan'),(651,'melakukan'),(652,'melalui'),(653,'melawan'),(654,'melihat'),(655,'melihatnya'),(656,'memandangkan'),(657,'memang'),(658,'memastikan'),(659,'membantu'),(660,'membawa'),(661,'memberi'),(662,'memberikan'),(663,'membolehkan'),(664,'membuat'),(665,'memerlukan'),(666,'memihak'),(667,'memiliki'),(668,'meminta'),(669,'memintakan'),(670,'memisalkan'),(671,'memperbuat'),(672,'mempergunakan'),(673,'memperkirakan'),(674,'memperlihatkan'),(675,'mempersiapkan'),(676,'mempersoalkan'),(677,'mempertanyakan'),(678,'mempunyai'),(679,'memulai'),(680,'memungkinkan'),(681,'menaiki'),(682,'menambah'),(683,'menambahkan'),(684,'menandaskan'),(685,'menanti'),(686,'menantikan'),(687,'menanya'),(688,'menanyai'),(689,'menanyakan'),(690,'menarik'),(691,'menawarkan'),(692,'mencapai'),(693,'mencari'),(694,'mencatatkan'),(695,'mendapat'),(696,'mendapatkan'),(697,'mendatang'),(698,'mendatangi'),(699,'mendatangkan'),(700,'menegaskan'),(701,'menerima'),(702,'menerusi'),(703,'mengadakan'),(704,'mengakhiri'),(705,'mengaku'),(706,'mengalami'),(707,'mengambil'),(708,'mengapa'),(709,'mengatakan'),(710,'mengatakannya'),(711,'mengenai'),(712,'mengerjakan'),(713,'mengetahui'),(714,'menggalakkan'),(715,'menggunakan'),(716,'menghadapi'),(717,'menghendaki'),(718,'mengibaratkan'),(719,'mengibaratkannya'),(720,'mengikut'),(721,'mengingat'),(722,'mengingatkan'),(723,'menginginkan'),(724,'mengira'),(725,'mengucapkan'),(726,'mengucapkannya'),(727,'mengumumkan'),(728,'mengungkapkan'),(729,'mengurangkan'),(730,'meninggal'),(731,'meningkat'),(732,'meningkatkan'),(733,'menjadi'),(734,'menjalani'),(735,'menjawab'),(736,'menjelang'),(737,'menjelaskan'),(738,'menokok'),(739,'menteri'),(740,'menuju'),(741,'menunjuk'),(742,'menunjuki'),(743,'menunjukkan'),(744,'menunjuknya'),(745,'menurut'),(746,'menuturkan'),(747,'menyaksikan'),(748,'menyampaikan'),(749,'menyangkut'),(750,'menyatakan'),(751,'menyebabkan'),(752,'menyebutkan'),(753,'menyediakan'),(754,'menyeluruh'),(755,'menyiapkan'),(756,'merasa'),(757,'mereka'),(758,'merekalah'),(759,'merosot'),(760,'merupakan'),(761,'meski'),(762,'meskipun'),(763,'mesyuarat'),(764,'metrotv'),(765,'meyakini'),(766,'meyakinkan'),(767,'milik'),(768,'militer'),(769,'minat'),(770,'minggu'),(771,'minta'),(772,'minyak'),(773,'mirip'),(774,'misal'),(775,'misalkan'),(776,'misalnya'),(777,'mobil'),(778,'modal'),(779,'mohd'),(780,'mudah'),(781,'mula'),(782,'mulai'),(783,'mulailah'),(784,'mulanya'),(785,'muncul'),(786,'mungkin'),(787,'mungkinkah'),(788,'musik'),(789,'musim'),(790,'nah'),(791,'naik'),(792,'nama'),(793,'namun'),(794,'nanti'),(795,'nantinya'),(796,'nasional'),(797,'negara'),(798,'negara-negara'),(799,'negeri'),(800,'new'),(801,'niaga'),(802,'nilai'),(803,'nomor'),(804,'noun'),(805,'nov'),(806,'november'),(807,'numeral'),(808,'numeralia'),(809,'nya'),(810,'nyaris'),(811,'nyatanya'),(812,'of'),(813,'ogos'),(814,'okt'),(815,'oktober'),(816,'olah'),(817,'oleh'),(818,'olehnya'),(819,'operasi'),(820,'orang'),(821,'organisasi'),(822,'pada'),(823,'padahal'),(824,'padanya'),(825,'pagetracker'),(826,'pagi'),(827,'pak'),(828,'paling'),(829,'pameran'),(830,'panjang'),(831,'pantas'),(832,'papan'),(833,'para'),(834,'paras'),(835,'parlimen'),(836,'partai'),(837,'parti'),(838,'particle'),(839,'pasar'),(840,'pasaran'),(841,'password'),(842,'pasti'),(843,'pastilah'),(844,'pasukan'),(845,'paticle'),(846,'pegawai'),(847,'pejabat'),(848,'pekan'),(849,'pekerja'),(850,'pelabur'),(851,'pelaburan'),(852,'pelancongan'),(853,'pelanggan'),(854,'pelbagai'),(855,'peluang'),(856,'pemain'),(857,'pembangunan'),(858,'pemberita'),(859,'pembinaan'),(860,'pemerintah'),(861,'pemerintahan'),(862,'pemimpin'),(863,'pendapatan'),(864,'pendidikan'),(865,'penduduk'),(866,'penerbangan'),(867,'pengarah'),(868,'pengeluaran'),(869,'pengerusi'),(870,'pengguna'),(871,'penggunaan'),(872,'pengurusan'),(873,'peniaga'),(874,'peningkatan'),(875,'penting'),(876,'pentingnya'),(877,'per'),(878,'perancis'),(879,'perang'),(880,'peratus'),(881,'percuma'),(882,'perdagangan'),(883,'perdana'),(884,'peringkat'),(885,'perjanjian'),(886,'perkara'),(887,'perkhidmatan'),(888,'perladangan'),(889,'perlu'),(890,'perlukah'),(891,'perlunya'),(892,'permintaan'),(893,'pernah'),(894,'perniagaan'),(895,'persekutuan'),(896,'persen'),(897,'persidangan'),(898,'persoalan'),(899,'pertama'),(900,'pertandingan'),(901,'pertanyaan'),(902,'pertanyakan'),(903,'pertubuhan'),(904,'pertumbuhan'),(905,'perubahan'),(906,'perusahaan'),(907,'pesawat'),(908,'peserta'),(909,'petang'),(910,'pihak'),(911,'pihaknya'),(912,'pilihan'),(913,'pinjaman'),(914,'polis'),(915,'polisi'),(916,'politik'),(917,'pos'),(918,'posisi'),(919,'presiden'),(920,'prestasi'),(921,'produk'),(922,'program'),(923,'projek'),(924,'pronomia'),(925,'pronoun'),(926,'proses'),(927,'proton'),(928,'provinsi'),(929,'pt'),(930,'pubdate'),(931,'pukul'),(932,'pula'),(933,'pulau'),(934,'pun'),(935,'punya'),(936,'pusat'),(937,'rabu'),(938,'radio'),(939,'raja'),(940,'rakan'),(941,'rakyat'),(942,'ramai'),(943,'rantau'),(944,'rasa'),(945,'rasanya'),(946,'rata'),(947,'raya'),(948,'rendah'),(949,'republik'),(950,'resmi'),(951,'ribu'),(952,'ringgit'),(953,'root'),(954,'ruang'),(955,'rumah'),(956,'rupa'),(957,'rupanya'),(958,'saat'),(959,'saatnya'),(960,'sabah'),(961,'sabtu'),(962,'sahaja'),(963,'saham'),(964,'saja'),(965,'sajalah'),(966,'sakit'),(967,'salah'),(968,'saling'),(969,'sama'),(970,'sama-sama'),(971,'sambil'),(972,'sampai'),(973,'sampaikan'),(974,'sana'),(975,'sangat'),(976,'sangatlah'),(977,'sarawak'),(978,'satu'),(979,'sawit'),(980,'saya'),(981,'sayalah'),(982,'sdn'),(983,'se'),(984,'sebab'),(985,'sebabnya'),(986,'sebagai'),(987,'sebagaimana'),(988,'sebagainya'),(989,'sebagian'),(990,'sebahagian'),(991,'sebaik'),(992,'sebaiknya'),(993,'sebaliknya'),(994,'sebanyak'),(995,'sebarang'),(996,'sebegini'),(997,'sebegitu'),(998,'sebelah'),(999,'sebelum'),(1000,'sebelumnya'),(1001,'sebenarnya'),(1002,'seberapa'),(1003,'sebesar'),(1004,'sebetulnya'),(1005,'sebisanya'),(1006,'sebuah'),(1007,'sebut'),(1008,'sebutlah'),(1009,'sebutnya'),(1010,'secara'),(1011,'secukupnya'),(1012,'sedang'),(1013,'sedangkan'),(1014,'sedemikian'),(1015,'sedikit'),(1016,'sedikitnya'),(1017,'seenaknya'),(1018,'segala'),(1019,'segalanya'),(1020,'segera'),(1021,'segi'),(1022,'seharusnya'),(1023,'sehingga'),(1024,'seingat'),(1025,'sejak'),(1026,'sejarah'),(1027,'sejauh'),(1028,'sejenak'),(1029,'sejumlah'),(1030,'sekadar'),(1031,'sekadarnya'),(1032,'sekali'),(1033,'sekali-kali'),(1034,'sekalian'),(1035,'sekaligus'),(1036,'sekalipun'),(1037,'sekarang'),(1038,'sekaranglah'),(1039,'sekecil'),(1040,'seketika'),(1041,'sekiranya'),(1042,'sekitar'),(1043,'sekitarnya'),(1044,'sekolah'),(1045,'sektor'),(1046,'sekurang'),(1047,'sekurangnya'),(1048,'sekuriti'),(1049,'sela'),(1050,'selagi'),(1051,'selain'),(1052,'selaku'),(1053,'selalu'),(1054,'selama'),(1055,'selama-lamanya'),(1056,'selamanya'),(1057,'selanjutnya'),(1058,'selasa'),(1060,'selepas'),(1061,'seluruh'),(1062,'seluruhnya'),(1063,'semacam'),(1064,'semakin'),(1065,'semalam'),(1066,'semampu'),(1067,'semampunya'),(1068,'semasa'),(1069,'semasih'),(1070,'semata'),(1071,'semaunya'),(1072,'sementara'),(1073,'semisal'),(1074,'semisalnya'),(1075,'sempat'),(1076,'semua'),(1077,'semuanya'),(1078,'semula'),(1079,'sen'),(1080,'sendiri'),(1081,'sendirian'),(1082,'sendirinya'),(1083,'senin'),(1084,'seolah'),(1085,'seolah-olah'),(1086,'seorang'),(1087,'sepak'),(1088,'sepanjang'),(1089,'sepantasnya'),(1090,'sepantasnyalah'),(1091,'seperlunya'),(1092,'seperti'),(1093,'sepertinya'),(1094,'sepihak'),(1095,'sept'),(1096,'september'),(1097,'serangan'),(1098,'serantau'),(1099,'seri'),(1100,'serikat'),(1101,'sering'),(1102,'seringnya'),(1103,'serta'),(1104,'serupa'),(1105,'sesaat'),(1106,'sesama'),(1107,'sesampai'),(1108,'sesegera'),(1109,'sesekali'),(1110,'seseorang'),(1111,'sesi'),(1112,'sesuai'),(1113,'sesuatu'),(1114,'sesuatunya'),(1115,'sesudah'),(1116,'sesudahnya'),(1117,'setelah'),(1118,'setempat'),(1119,'setengah'),(1120,'seterusnya'),(1121,'setiap'),(1122,'setiausaha'),(1123,'setiba'),(1124,'setibanya'),(1125,'setidak'),(1126,'setidaknya'),(1127,'setinggi'),(1128,'seusai'),(1129,'sewaktu'),(1130,'siap'),(1131,'siapa'),(1132,'siapakah'),(1133,'siapapun'),(1134,'siaran'),(1135,'sidang'),(1136,'singapura'),(1137,'sini'),(1138,'sinilah'),(1139,'sistem'),(1141,'soalnya'),(1142,'sokongan'),(1143,'sri'),(1144,'stasiun'),(1145,'suara'),(1146,'suatu'),(1147,'sudah'),(1148,'sudahkah'),(1149,'sudahlah'),(1150,'sukan'),(1151,'suku'),(1152,'sumber'),(1153,'sungai'),(1154,'supaya'),(1155,'surat'),(1156,'susut'),(1157,'syarikat'),(1158,'syed'),(1159,'tadi'),(1160,'tadinya'),(1161,'tahap'),(1162,'tahu'),(1163,'tahun'),(1164,'tak'),(1165,'tama'),(1166,'tambah'),(1167,'tambahnya'),(1168,'tampak'),(1169,'tampaknya'),(1170,'tampil'),(1171,'tan'),(1172,'tanah'),(1173,'tandas'),(1174,'tandasnya'),(1175,'tanggal'),(1176,'tanpa'),(1177,'tanya'),(1178,'tanyakan'),(1179,'tanyanya'),(1180,'tapi'),(1181,'tawaran'),(1182,'tegas'),(1183,'tegasnya'),(1185,'telah'),(1186,'televisi'),(1188,'tempat'),(1189,'tempatan'),(1190,'tempo'),(1191,'tempoh'),(1192,'tenaga'),(1194,'tentang'),(1195,'tentara'),(1196,'tentu'),(1197,'tentulah'),(1198,'tentunya'),(1199,'tepat'),(1200,'terakhir'),(1201,'terasa'),(1202,'terbaik'),(1203,'terbang'),(1204,'terbanyak'),(1205,'terbesar'),(1206,'terbuka'),(1207,'terdahulu'),(1208,'terdapat'),(1209,'terdiri'),(1210,'terhadap'),(1211,'terhadapnya'),(1212,'teringat'),(1213,'terjadi'),(1214,'terjadilah'),(1215,'terjadinya'),(1216,'terkait'),(1217,'terkenal'),(1218,'terkira'),(1219,'terlalu'),(1220,'terlebih'),(1221,'terletak'),(1222,'terlihat'),(1223,'termasuk'),(1224,'ternyata'),(1225,'tersampaikan'),(1226,'tersebut'),(1227,'tersebutlah'),(1228,'tertentu'),(1229,'tertuju'),(1230,'terus'),(1231,'terutama'),(1232,'testimoni'),(1233,'testimony'),(1234,'tetap'),(1235,'tetapi'),(1236,'the'),(1237,'tiada'),(1238,'tiap'),(1239,'tiba'),(1240,'tidak'),(1241,'tidakkah'),(1242,'tidaklah'),(1243,'tidaknya'),(1244,'tiga'),(1245,'tim'),(1246,'timbalan'),(1248,'tindakan'),(1249,'tinggal'),(1250,'tinggi'),(1251,'tingkat'),(1252,'toh'),(1253,'tokoh'),(1254,'try'),(1255,'tun'),(1256,'tunai'),(1257,'tunjuk'),(1258,'turun'),(1259,'turut'),(1260,'tutur'),(1261,'tuturnya'),(1262,'tv'),(1263,'uang'),(1264,'ucap'),(1265,'ucapnya'),(1266,'udara'),(1267,'ujar'),(1268,'ujarnya'),(1269,'umum'),(1270,'umumnya'),(1271,'unescape'),(1272,'ungkap'),(1273,'ungkapnya'),(1274,'unit'),(1275,'universitas'),(1276,'untuk'),(1277,'untung'),(1278,'upaya'),(1279,'urus'),(1280,'usah'),(1281,'usaha'),(1282,'usai'),(1283,'user'),(1284,'utama'),(1285,'utara'),(1286,'var'),(1287,'versi'),(1288,'waduh'),(1289,'wah'),(1290,'wahai'),(1291,'wakil'),(1292,'waktu'),(1293,'waktunya'),(1294,'walau'),(1295,'walaupun'),(1296,'wang'),(1297,'wanita'),(1298,'warga'),(1299,'warta'),(1300,'wib'),(1301,'wilayah'),(1302,'wong'),(1303,'word'),(1304,'ya'),(1305,'yaitu'),(1306,'yakin'),(1307,'yakni'),(1308,'yang'),(1309,'zaman'),(1311,'gambar'),(1312,'judul'),(1313,'tugas akhir'),(1314,'halaman'),(1315,'lampiran'),(1316,'i'),(1317,'ii'),(1318,'iii'),(1319,'iv'),(1320,'v'),(1321,'vi'),(1322,'vii'),(1323,'viii'),(1324,'ix'),(1325,'x'),(1326,'xi'),(1327,'xii'),(1328,'xiii'),(1329,'xiv'),(1330,'xv'),(1331,'xvi'),(1332,'xvii'),(1333,'xviii'),(1334,'xix'),(1335,'xx'),(1336,'d');