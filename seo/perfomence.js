const puppeteer = require('puppeteer');

async function checkIndexing(domain) {
    const browser = await puppeteer.launch();
    const page = await browser.newPage();

    // Go to Google and perform a search query
    await page.goto('https://www.google.com');
    await page.waitForSelector('input[name="q"]');
    await page.type('input[name="q"]', `site:${domain}`);
    await page.keyboard.press('Enter');
    await page.waitForSelector('#search');

    // Check if results are found
    const results = await page.evaluate(() => {
        const resultStats = document.querySelector('#result-stats');
        return resultStats ? resultStats.innerText : 'No results found';
    });

    console.log(results);

    await browser.close();
}


const domain = 'acecsaudi.com';
checkIndexing(domain);
