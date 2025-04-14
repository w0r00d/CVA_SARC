<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
        CREATE TRIGGER beneficiary_name_history
           BEFORE UPDATE ON beneficiaries
           FOR EACH ROW
           BEGIN
             IF NEW.fullname != OLD.fullname THEN
               SET NEW.h_fullname = OLD.fullname;
           End IF;
           END;
       CREATE TRIGGER beneficiary_id_history
       BEFORE UPDATE ON beneficiaries
       FOR EACH ROW
       BEGIN
        IF NEW.national_id != OLD.national_id THEN
           SET NEW.h_national_id = OLD.national_id;
                END IF;
       END;

        CREATE TRIGGER beneficiary_phone_history
       BEFORE UPDATE ON beneficiaries
       FOR EACH ROW
       BEGIN
        IF NEW.phonenumber != OLD.phonenumber THEN
           SET NEW.h_phonenumber = OLD.phonenumber;
                END IF;
       END;

        CREATE TRIGGER beneficiary_r_name_history
       BEFORE UPDATE ON beneficiaries
       FOR EACH ROW
       BEGIN
       IF NEW.recipient_name != OLD.recipient_name THEN
           SET NEW.h_recipient_name = OLD.recipient_name;
                END IF;
       END;

          CREATE TRIGGER beneficiary_r_phone_history
       BEFORE UPDATE ON beneficiaries
       FOR EACH ROW
       BEGIN
       IF NEW.recipient_phone != OLD.recipient_phone THEN
           SET NEW.h_recipient_phone = OLD.recipient_phone;
                END IF;
       END;

           CREATE TRIGGER beneficiary_r_id_history
       BEFORE UPDATE ON beneficiaries
       FOR EACH ROW
       BEGIN
        IF NEW.recipient_nid != OLD.recipient_nid THEN
           SET NEW.h_recipient_nid = OLD.recipient_nid;
                END IF;
       END;

           CREATE TRIGGER beneficiary_t_value_history
       BEFORE UPDATE ON beneficiaries
       FOR EACH ROW
       BEGIN
        IF NEW.transfer_value != OLD.transfer_value THEN
           SET NEW.h_transfer_value = OLD.transfer_value;
                END IF;
       END;

         CREATE TRIGGER beneficiary_t_count_history
       BEFORE UPDATE ON beneficiaries
       FOR EACH ROW
       BEGIN
        IF NEW.transfer_count != OLD.transfer_count THEN
           SET NEW.h_transfer_count = OLD.transfer_count;
           END IF;
       END;

  
   ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_history_trigger');
    }
};
