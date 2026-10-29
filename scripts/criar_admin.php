<?php
if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

require_once __DIR__ . '/../config/conf.php';

function ler_entrada(string $prompt, bool $secreta = false): string
{
    fwrite(STDOUT, $prompt);
    $podeOcultar = $secreta && PHP_OS_FAMILY !== 'Windows' && function_exists('shell_exec');
    if ($podeOcultar) {
        shell_exec('stty -echo');
    }
    $valor = trim((string) fgets(STDIN));
    if ($podeOcultar) {
        shell_exec('stty echo');
        fwrite(STDOUT, PHP_EOL);
    }
    return $valor;
}

$nome = ler_entrada('Nome do administrador: ');
$email = strtolower(ler_entrada('E-mail do administrador: '));
$senha = ler_entrada('Senha (mínimo 8 caracteres): ', true);

if ($nome === '' || mb_strlen($nome) > 120 || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($senha) < 8) {
    fwrite(STDERR, "Dados inválidos. Nenhuma conta foi criada.\n");
    exit(1);
}

try {
    $check = $pdo->prepare('SELECT id FROM usuarios WHERE email = ? LIMIT 1');
    $check->execute([$email]);
    if ($check->fetchColumn()) {
        fwrite(STDERR, "Já existe uma conta com esse e-mail.\n");
        exit(1);
    }

    $hash = password_hash($senha, PASSWORD_DEFAULT);
    $insert = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, perfil) VALUES (?, ?, ?, 'admin')");
    $insert->execute([$nome, $email, $hash]);
    fwrite(STDOUT, "Conta administrativa criada. Remova ou proteja este script após o uso.\n");
} catch (Throwable $e) {
    error_log('Falha ao criar conta administrativa.');
    fwrite(STDERR, "Não foi possível criar a conta. Verifique a conexão e o banco de dados.\n");
    exit(1);
}
