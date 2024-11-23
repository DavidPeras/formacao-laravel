# Formação Laravel + Filament

1. Para começar faz download deste repositório para uma pasta a tua escolha. Seguidamente abre a pasta no VS Code e efetua novamente a configuração da extensão SFTP, substituindo o ficheiro sftp.json pelo teu, de forma semelhante ao guião.

2. Substitui também o ficheiro .env pelo teu, tal como no guião.

3. Dá upload do código para a máquina remota com o comando SFTP: Upload Project. (semelhante ao guião).

4. Entra na máquina remota por ssh da mesma forma que no guião e executa os seguintes comandos:

5. **Ir para dentro da pasta do projeto**: `cd FormacaoLaravel`

5. **Instalar dependências**: `composer i`

6. **Correr migrations novamente**: `php artisan migrate:fresh`

7. **Criar user para o Filament**: `php artisan make:filament-user`

8. **Setup do Filament Shield**: `php artisan shield:install --fresh `

9. **Command 5**: `php artisan serve --host 0.0.0.0 --port=80`

10. Deves agora conseguir aceder à aplicação pelo url http://84.247.164.145:403N/admin/login onde N é teu número da formação.
