import { test, expect } from '@playwright/test';

test('Consultar CPF e verificar nome do cliente', async ({ page }) => {

  await page.goto('http://localhost:5173/'); 

  await page.fill('#cpfInput', '12345678900');

  await page.click('#consultarCPFButton');

  await page.waitForSelector('#clienteNome');

  const clienteNome = await page.textContent('#clienteNome');

  expect(clienteNome).toBe('João');
});
