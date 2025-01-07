<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Isi Keluhan</title>
  <link rel="stylesheet" href="isikeluhan.css">
</head>
<body>
  <header class="header">
    <div class="header-container">
      <button class="btn-back" onclick="history.back()">← Back</button>
      <h1>Puskesmas Cinta Kasih Satu Hati</h1>
    </div>
  </header>

  <main class="main-content">
    <section class="keluhan-section">
      <h2>Isi Keluhan</h2>
      <form action="keluhan_success.html" method="post" class="keluhan-form">
        <div class="form-group">
          <label for="keluhan">Isi Keluhan Anda</label>
          <textarea id="keluhan" name="keluhan" rows="5" placeholder="Tulis keluhan Anda di sini..." required></textarea>
        </div>
        <div class="form-group">
          <button type="submit" class="btn-pilih">Submit</button>
        </div>
      </form>
    </section>
  </main>
</body>
</html>
