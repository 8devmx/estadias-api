<?php

namespace Database\Seeders;

use App\Models\Company;
use Doctrine\DBAL\Schema\Table;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		$table = new Company();
        $table->name = "UNID";
		$table->mail = "unid@mail.com.mx";
		$table->phone = "(502) 831-9837";
		$table->contact = "1-749-710-0131";
		$table->logo = "TFG16GXR8JO";

        $table->save();

		$table = new Company();
        $table->name = "San Pech";
		$table->mail = "sanpech@protonmail.mx";
		$table->phone = "(258) 698-1537";
		$table->contact = "1-568-298-34867";
		$table->logo = "TFG16GXR8JO";

        $table->save();

        $table = new Company();

        $table->name = "Lectus Quis LLP";
        $table->mail = "cum.sociis@protonmail.org";
        $table->phone = "1-433-859-2648";
        $table->contact = "1-565-741-3657";
        $table->logo = "DYV68BJP3CC";   
        
        $table->save();

        $table = new Company();
        $table->name = "Ut Pellentesque Eget Foundation";
		$table->mail = "dignissim.maecenas@google.edu";
		$table->phone = "(725) 308-5987";
		$table->contact = "(947) 802-7460";
		$table->logo = "OML83NKD8NE";

        $table->save();

    
        $table = new Company();
        $table->name = "Turpis Nec Mauris Corp.";
		$table->mail = "tempor@aol.net";
		$table->phone = "1-634-663-2234";
		$table->contact = "1-102-908-8150";
		$table->logo = "YFG92TJF2TX";

        $table->save();

        $table = new Company();
        $table->name = "In Cursus Et LLP";
		$table->mail = "orci.tincidunt@yahoo.ca";
		$table->phone = "(675) 726-6475";
		$table->contact = "1-900-336-5658";
		$table->logo = "QNZ18KTS1WR";

        $table->save();

        $table = new Company();
        $table->name = "Mauris Eu Elit Company";
		$table->mail = "erat.nonummy@outlook.org";
		$table->phone = "(439) 249-2174";
		$table->contact = "1-762-270-1487";
		$table->logo = "HWB75RXU8HG";

        $table->save();

        $table = new Company();
        $table->name = "Nisi Mauris Inc.";
		$table->mail = "urna.justo@protonmail.org";
		$table->phone = "1-935-602-7468";
		$table->contact = "(336) 263-7170";
		$table->logo = "DED45WTJ9PL";

        $table->save();

        $table = new Company();
        $table->name = "Vestibulum Massa Rutrum Corp.";
		$table->mail = "magna.phasellus@google.edu";
		$table->phone = "(584) 346-0650";
		$table->contact = "(838) 759-5356";
		$table->logo = "QEL47TMS5QE";

        $table->save();

        $table = new Company();
        $table->name = "Sodales Purus Associates";
		$table->mail = "mollis.nec.cursus@protonmail.edu";
		$table->phone = "(518) 524-5555";
		$table->contact = "1-472-238-6213";
		$table->logo = "ZWM12NIA3AL";

        $table->save();

        $table = new Company();
        $table->name = "Ultricies Ligula Limited";
		$table->mail = "orci.lacus@aol.org";
		$table->phone = "(182) 604-4151";
		$table->contact = "1-537-822-6640";
		$table->logo = "PPS53OMX8PB";

        $table->save();

        $table = new Company();
        $table->name = "Ullamcorper Industries";
		$table->mail = "gravida.praesent@aol.couk";
		$table->phone = "(380) 778-2131";
		$table->contact = "1-625-125-1360";
		$table->logo = "TPL72NWX5IK";

        $table->save();

        $table = new Company();
        $table->name = "Lorem Company";
		$table->mail = "nec@outlook.couk";
		$table->phone = "(468) 496-5381";
		$table->contact = "(767) 985-1209";
		$table->logo = "EOT52VJP8IE";

        $table->save();

        $table = new Company();
        $table->name = "Cursus Diam Incorporated";
		$table->mail = "sed.congue@google.ca";
		$table->phone = "1-878-852-2791";
		$table->contact = "(472) 264-0657";
		$table->logo = "SIM71CKO1CB";

        $table->save();

        $table = new Company();
        $table->name = "Nisl Sem Incorporated";
		$table->mail = "urna.ut@google.net";
		$table->phone = "(660) 527-0836";
		$table->contact = "1-351-773-1886";
		$table->logo = "KTL38DRU6KQ";

        $table->save();

        $table = new Company();
        $table->name = "Nisi Mauris Ltd";
		$table->mail = "tempus.eu.ligula@google.ca";
		$table->phone = "(849) 584-1282";
		$table->contact = "(365) 364-0860";
		$table->logo = "MBP37TJD7OD";

        $table->save();

        $table = new Company();
        $table->name = "Miriam Church";
		$table->mail = "neque.morbi@icloud.edu";
		$table->phone = "1-681-637-1834";
		$table->contact = "1-366-846-9418";
		$table->logo = "PIK04WPX3KE";

        $table->save();

        $table = new Company();
        $table->name = "Libero Dui Nec Industries";
		$table->mail = "morbi@yahoo.couk";
		$table->phone = "(785) 270-0944";
		$table->contact = "(886) 181-8811";
		$table->logo = "HQM94HNQ5UW";

        $table->save();

        $table = new Company();
        $table->name = "Vitae Aliquet Inc.";
		$table->mail = "convallis@yahoo.edu";
		$table->phone = "(726) 346-1443";
		$table->contact = "1-230-418-2736";
		$table->logo = "CVC66GQE1UD";

        $table->save();

        $table = new Company();
        $table->name = "Lacus Ut LLP";
		$table->mail = "non.lorem.vitae@protonmail.net";
		$table->phone = "(684) 152-4721";
		$table->contact = "1-365-335-9062";
		$table->logo = "IDG88TKJ8WX";

        $table->save();

        $table = new Company();
        $table->name = "Mus Proin Foundation";
		$table->mail = "eget.odio@outlook.edu";
		$table->phone = "1-766-479-5181";
		$table->contact = "(241) 762-7464";
		$table->logo = "WSS72PVD9ES";

        $table->save();

        $table = new Company();
        $table->name = "Sed Congue Elit Company";
		$table->mail = "enim.consequat@protonmail.ca";
		$table->phone = "(502) 831-9837";
		$table->contact = "1-749-710-0131";
		$table->logo = "TFG16GXR8JO";

        $table->save();

    }
}
