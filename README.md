# 19th Chapter - Devi Rachma Anjani



## 🚀 Cara Deploy ke Vercel (GRATIS)

### **Metode 1: Deploy via Vercel Dashboard (PALING MUDAH)**

1. **Buat Akun Vercel**
   - Kunjungi: https://vercel.com/signup
   - Pilih "Continue with GitHub" (atau email)
   - Ikuti proses registrasi

2. **Persiapkan File**
   - Pastikan semua file ada di satu folder:
     ```
     website-folder/
     ├── index.html
     ├── style.css
     ├── script.js
     ├── vercel.json
     ├── merpati.jpg (foto burung merpati)
     ├── lagu.mp3 (file musik Monokrom - Tulus)
     └── kenangan.mp4 (video kenangan)
     ```

3. **Upload ke Vercel**
   - Login ke https://vercel.com/dashboard
   - Klik tombol **"Add New..."** → **"Project"**
   - Pilih tab **"Deploy from"** → klik **"Browse"**
   - Pilih folder website Anda (yang berisi semua file)
   - Klik **"Deploy"**
   - Tunggu beberapa detik sampai selesai
   - Website Anda sudah LIVE! 🎉

4. **Dapatkan Link Website**
   - Setelah deploy selesai, Anda akan dapat link seperti:
     `https://nama-project-xxx.vercel.app`
   - Link ini bisa langsung dibagikan!

---

### **Metode 2: Deploy via GitHub (Lebih Profesional)**

1. **Buat Repository GitHub**
   - Kunjungi: https://github.com/new
   - Buat repository baru (public atau private)
   - Jangan centang "Add README"
   - Klik "Create repository"

2. **Upload File ke GitHub**
   - Di halaman repository, klik **"uploading an existing file"**
   - Drag & drop semua file website Anda
   - Klik **"Commit changes"**

3. **Connect ke Vercel**
   - Login ke https://vercel.com/dashboard
   - Klik **"Add New..."** → **"Project"**
   - Klik **"Import Git Repository"**
   - Pilih repository GitHub Anda
   - Klik **"Import"**
   - Klik **"Deploy"**
   - Selesai! 🎉

4. **Auto Deploy**
   - Setiap kali Anda update file di GitHub
   - Vercel otomatis deploy ulang website Anda
   - Sangat praktis untuk update konten!

---

### **Metode 3: Deploy via Vercel CLI (Advanced)**

1. **Install Vercel CLI**
   ```bash
   npm install -g vercel
   ```

2. **Login**
   ```bash
   vercel login
   ```

3. **Deploy**
   ```bash
   cd folder-website-anda
   vercel
   ```
   - Tekan Enter untuk semua pertanyaan
   - Website langsung deploy!

4. **Deploy untuk Production**
   ```bash
   vercel --prod
   ```

---

## 📝 Checklist Sebelum Deploy

- [ ] File `index.html` ada
- [ ] File `style.css` ada
- [ ] File `script.js` ada
- [ ] File `vercel.json` ada
- [ ] File `merpati.jpg` ada (foto burung)
- [ ] File `lagu.mp3` ada (musik Monokrom)
- [ ] File `kenangan.mp4` ada (video)
- [ ] Semua file berada di satu folder yang sama

---

## 🎨 Custom Domain (Opsional)

Setelah deploy, Anda bisa menambahkan custom domain:

1. Beli domain di Namecheap, GoDaddy, atau Niagahoster
2. Di Vercel Dashboard → Pilih project Anda
3. Klik **"Settings"** → **"Domains"**
4. Tambahkan domain Anda
5. Ikuti instruksi untuk setting DNS
6. Selesai! Domain custom siap digunakan

---

## 🔧 Troubleshooting

**Q: File tidak muncul setelah deploy?**
- Pastikan nama file sama persis (case-sensitive)
- Cek di browser console untuk error
- Pastikan path file benar di HTML

**Q: Video/Audio tidak bisa diputar?**
- Pastikan format file didukung (MP4 untuk video, MP3 untuk audio)
- Ukuran file tidak terlalu besar (max 50MB untuk free plan)
- Coba compress file jika terlalu besar

**Q: Website lambat loading?**
- Compress gambar menggunakan TinyPNG atau Squoosh
- Compress video menggunakan HandBrake
- Vercel free plan sudah cukup cepat untuk website seperti ini

---

## 💡 Tips

1. **Backup File**: Selalu simpan backup di komputer/Google Drive
2. **Test Lokal**: Buka `index.html` di browser sebelum deploy
3. **Update Mudah**: Upload file baru dengan nama sama untuk update
4. **Share Link**: Link Vercel bisa langsung dibagikan via WA, IG, dll

---

## 📱 Support

Website ini sudah responsive dan bisa dibuka di:
- Desktop/Laptop
- Tablet
- Mobile Phone
- Semua browser modern (Chrome, Firefox, Safari, Edge)

---

**Made with ❤️ for Devi Rachma Anjani's 19th Birthday**

Selamat ulang tahun! Semoga hari spesialmu penuh kebahagiaan! 🎂🎉
