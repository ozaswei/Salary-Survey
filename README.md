<h1 align="center">💼 Salary Survey Tool 📊</h1>

<p align="center">
  <em>Discover salary insights from Google Jobs listings in real-time</em><br/>
  <strong>Built with Laravel + Dark Mode UI + Chart.js</strong>
</p>

---

<h2>🔍 What It Does</h2>

<p>
This web application allows users to search for any <strong>job title</strong> in any <strong>location</strong> and get:
</p>

<ul>
  <li>📈 <strong>Highest Salary</strong></li>
  <li>📉 <strong>Lowest Salary</strong></li>
  <li>⚖️ <strong>Average Salary</strong></li>
  <li>🏢 <strong>Top 5 Job Listings</strong> – including job title, company, and links</li>
</ul>

<p>
Great for <strong>career planning</strong>, <strong>salary negotiation</strong>, or <strong>job switching</strong>.
</p>

---

<h2>🧠 Tech Stack</h2>

<ul>
  <li>⚙️ <strong>Laravel</strong> – backend logic and scraping logic</li>
  <li>🎨 <strong>Blade</strong> – for dynamic frontend templating</li>
  <li>🌙 <strong>Dark Mode UI</strong> – custom CSS for modern look</li>
  <li>📊 <strong>Chart.js</strong> – to render beautiful salary curves</li>
</ul>

---

<h2>🚀 How to Use</h2>

<ol>
  <li>Enter a <code>job title</code> and <code>location</code> (e.g., "Web Developer", "Toronto")</li>
  <li>Click on <strong>Submit</strong></li>
  <li>View the top 5 job results, and the salary range (lowest, average, highest)</li>
</ol>

<p>
Includes a <strong>Back to Portfolio</strong> button for easy navigation.
</p>

---

<h2>📂 Folder Structure</h2>

<pre>
├── app/Http/Controllers/ScrapeController.php
├── resources/views/portfolio/salarySurvey.blade.php
├── public/assets/projectSection.js
├── routes/web.php
</pre>

---

<h2>📸 Screenshots</h2>

<p>
<i>Add your screenshots here showing the UI, dark mode, and salary curve</i>
</p>

---

<h2>🛠️ Setup Instructions</h2>

<pre>
git clone https://github.com/yourusername/salary-survey-tool.git
cd salary-survey-tool
composer install
cp .env.example .env
php artisan key:generate
php artisan serve
</pre>

<p>
Make sure to configure your Google scraping service/API inside <code>SerpScraper.php</code>.
</p>

---

<h2>🙌 Credits</h2>

<ul>
  <li>👨‍💻 Developed by: <a href="https://ozaswei.com.np">Ozaswei Bahadur Tamrakar</a></li>
  <li>🔗 Portfolio: <a href="https://ozaswei.com.np/">portfolio.test</a></li>
</ul>

---

<h2>📃 License</h2>

<p>
MIT License – Free to use, share, and improve with credit.
</p>

