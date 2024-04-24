const puppeteer = require('puppeteer');

(async () => {
  try {
    const browser = await puppeteer.launch({ headless: true, ignoreHTTPSErrors: true });

    const page = await browser.newPage();
    
    const url = 'https://localhost/webapp/login.php'; // URL della pagina di login
    
    await page.goto(url);
    
    // Attendi che il selettore per il campo username sia caricato
    await page.waitForSelector('#username');
    
    // Compila il campo username con le credenziali
    await page.type('#username', 'admin'); // Sostituisci 'username' con il nome utente desiderato
    
    // Attendi che il selettore per il campo password sia caricato
    await page.waitForSelector('#password');
    
    // Compila il campo password con le credenziali
    await page.type('#password', 'password'); // Sostituisci 'password' con la password desiderata
    
    // Attendi che il selettore per il pulsante di login sia caricato
    await page.waitForSelector('input[name="login"]');
    
    // Effettua il login cliccando sul pulsante di login
    await Promise.all([
      page.waitForNavigation(), // Attendere la navigazione alla pagina successiva
      page.click('input[name="login"]')
    ]);
    
    
    // Verificare se l'URL corrente è quello della pagina dopo il login
    if (page.url() === 'https://localhost/webapp/admin.php') {
    console.log('Login avvenuto con successo!');
  } else {
    console.log('Login non riuscito.');
  }
    
    
    // Naviga verso la pagina che visualizza tutti i commenti
    await page.goto('https://localhost/webapp/admin.php');

    // Leggi i commenti 
    const comments = await page.evaluate(() => { 
      const commentsList = [];
      document.querySelectorAll('.comment').forEach(comment => { 
        commentsList.push(comment.innerText); 
      }); 
      return commentsList; 
    }); 
    console.log(comments); 
    // Stampa i commenti 
    // Chiudi il browser 
    await browser.close(); 
  } catch (error) {
    console.error('Errore durante l\'esecuzione dello script:', error);
  }
})();

