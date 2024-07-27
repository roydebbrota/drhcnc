<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('course_name')->nullable();
            $table->integer('session')->nullable();
            $table->string('slug');
            $table->string('name_bangla')->nullable();
            $table->string('father')->nullable();
            $table->string('mother')->nullable();
            $table->string('phone')->unique();
            $table->string('father_phone')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('blood_group')->nullable();
            $table->enum('nid_birth_reg', ['NID', 'Birth Registration'])->nullable();
            $table->string('nid_birth_reg_num')->nullable();
            $table->enum('hostel', ['Yes', 'No'])->nullable();
            $table->integer('division')->nullable();
            $table->integer('district')->nullable();
            $table->integer('upazila')->nullable();
            $table->string('thana')->nullable();
            $table->string('post_office')->nullable();
            $table->integer('post_code')->nullable();
            $table->string('village')->nullable();
            $table->string('present_address')->nullable();
            $table->string('ssc_exam_name')->nullable();
            $table->string('ssc_board')->nullable();
            $table->string('ssc_roll')->nullable();
            $table->string('ssc_reg_no')->nullable();
            $table->string('ssc_gpa')->nullable();
            $table->string('ssc_year')->nullable();
            $table->string('hsc_exam_name')->nullable();
            $table->string('hsc_board')->nullable();
            $table->string('hsc_roll')->nullable();
            $table->string('hsc_reg_no')->nullable();
            $table->string('hsc_gpa')->nullable();
            $table->string('hsc_year')->nullable();
            $table->string('govt_exam_name')->nullable();
            $table->string('govt_roll')->nullable();
            $table->string('govt_score')->nullable();
            $table->string('govt_serial')->nullable();
            $table->string('govt_user_id')->nullable();
            $table->string('govt_password')->nullable();
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('image')->nullable();
            $table->string('signature')->nullable();
            $table->longText('note')->nullable();
            $table->string('contract_amount')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('role', ['SuperAdmin', 'Admin', 'Student', 'Account', 'Teacher'])->default('Student');
            $table->enum('student_access', ['Yes', 'No'])->default('Yes');
            $table->enum('status', ['Active', 'Processing','Rejectted', 'Confirmed', 'Inactive', 'Completed'])->default('Processing');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
