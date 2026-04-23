use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemasukans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('nama_lomba'); // Sesi Pagi / Malam
            $table->integer('jumlah_peserta');
            $table->integer('harga_tiket');
            $table->integer('total'); // auto hitung
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemasukans');
    }
};