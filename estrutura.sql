-- Criação do banco de dados
CREATE DATABASE gestao_acesso;
\c gestao_acesso;

-- 1. Tabela de perfis (substitui ENUM tipo_usuario)
CREATE TABLE perfis (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(50) NOT NULL UNIQUE
);

-- 2. Tabela de permissões
CREATE TABLE permissoes (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL UNIQUE,
    descricao TEXT
);

-- 3. Associação entre perfis e permissões
CREATE TABLE perfil_permissoes (
    perfil_id INT NOT NULL,
    permissao_id INT NOT NULL,
    PRIMARY KEY (perfil_id, permissao_id),
    FOREIGN KEY (perfil_id) REFERENCES perfis(id),
    FOREIGN KEY (permissao_id) REFERENCES permissoes(id)
);

-- 4. Tabela de usuários com FK para perfis
CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    matricula VARCHAR(50) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    perfil_id INT NOT NULL,
    FOREIGN KEY (perfil_id) REFERENCES perfis(id)
);

-- 5. Tabela de acessos liberados
CREATE TABLE acessos_liberados (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    matricula VARCHAR(255) NOT NULL,
    localizacao VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- 6. Tabela de motoristas oficiais
CREATE TABLE motoristas_oficiais (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    matricula VARCHAR(50) NOT NULL,
    foto VARCHAR(255) NOT NULL
);

-- 7. Tipo ENUM para tipo_veiculo
DO $$ BEGIN
    CREATE TYPE tipo_veiculo AS ENUM ('OFICIAL', 'PARTICULAR', 'MOTO');
EXCEPTION WHEN duplicate_object THEN null;
END $$;

-- 8. Tabela de veículos
CREATE TABLE veiculos (
    id SERIAL PRIMARY KEY,
    placa VARCHAR(8) NOT NULL UNIQUE,
    modelo VARCHAR(255) NOT NULL,
    cor VARCHAR(50) NOT NULL,
    tipo tipo_veiculo NOT NULL,
    marca VARCHAR(255) NOT NULL,
    localizacao VARCHAR(255) NOT NULL,
    nome VARCHAR(255),
    acesso_id INT,
    CONSTRAINT fk_acesso FOREIGN KEY (acesso_id) REFERENCES acessos_liberados(id)
);

-- ✅ NOVA: Tabela de localizações (estacionamentos)
CREATE TABLE localizacoes (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL UNIQUE
);

-- ✅ NOVA: Tabela estacionamentos com FK para localizacoes
CREATE TABLE estacionamentos (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL UNIQUE,
    endereco VARCHAR(255),
    localizacao_id INT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (localizacao_id) REFERENCES localizacoes(id) ON DELETE CASCADE
);

-- 9. Tabela de vagas (agora com referência a localizacao_id)
CREATE TABLE vagas (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    vagas_particulares INT NOT NULL DEFAULT 0,
    vagas_oficiais INT NOT NULL DEFAULT 0,
    vagas_motos INT NOT NULL DEFAULT 0,
    localizacao_id INT NOT NULL,
    FOREIGN KEY (localizacao_id) REFERENCES localizacoes(id) ON DELETE CASCADE
);

-- 10. Tabela de registros de veículos
CREATE TABLE registro_veiculos (
    id SERIAL PRIMARY KEY,
    placa VARCHAR(8) NOT NULL,
    marca VARCHAR(50) NOT NULL,
    modelo VARCHAR(50) NOT NULL,
    cor VARCHAR(20) NOT NULL,
    tipo tipo_veiculo NOT NULL,
    motorista_entrada_id INT NOT NULL,
    motorista_saida_id INT,
    horario_entrada TIMESTAMP NOT NULL,
    horario_saida TIMESTAMP,
    usuario_logado_id INT NOT NULL,
    usuario_saida_id INT,
    localizacao VARCHAR(50) NOT NULL,
    CONSTRAINT fk_placa FOREIGN KEY (placa) REFERENCES veiculos(placa),
    CONSTRAINT fk_motorista_entrada FOREIGN KEY (motorista_entrada_id) REFERENCES motoristas_oficiais(id),
    CONSTRAINT fk_motorista_saida FOREIGN KEY (motorista_saida_id) REFERENCES motoristas_oficiais(id),
    CONSTRAINT fk_usuario_logado FOREIGN KEY (usuario_logado_id) REFERENCES usuarios(id),
    CONSTRAINT fk_usuario_saida FOREIGN KEY (usuario_saida_id) REFERENCES usuarios(id)
);

-- 11. Tabela de ocorrências
CREATE TABLE ocorrencias (
    id SERIAL PRIMARY KEY,
    placa VARCHAR(8) NOT NULL,
    ocorrencia TEXT NOT NULL,
    horario TIMESTAMP NOT NULL,
    usuario_id INT NOT NULL,
    CONSTRAINT fk_ocorrencia_placa FOREIGN KEY (placa) REFERENCES veiculos(placa),
    CONSTRAINT fk_ocorrencia_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- 12. Inserções iniciais em perfis
INSERT INTO perfis (nome) VALUES 
('administrador'),
('vigilante'),
('recepcionista');

-- 13. Inserções iniciais em permissões
INSERT INTO permissoes (nome, descricao) VALUES
('registrar_entrada', 'Registrar entrada de veículo'),
('registrar_saida', 'Registrar saída de veículo'),
('cadastrar_usuario', 'Cadastrar novo usuário'),
('cadastrar_veiculo', 'Cadastrar veículo'),
('registrar_ocorrencia', 'Registrar ocorrências'),
('visualizar_relatorios', 'Visualizar relatórios');

-- 14. Associações entre perfis e permissões
-- Vigilante
INSERT INTO perfil_permissoes (perfil_id, permissao_id)
SELECT 2, id FROM permissoes WHERE nome IN (
    'registrar_entrada',
    'registrar_saida',
    'registrar_ocorrencia',
    'cadastrar_veiculo'
);

-- Recepcionista (mesmas permissões do vigilante)
INSERT INTO perfil_permissoes (perfil_id, permissao_id)
SELECT 3, id FROM permissoes WHERE nome IN (
    'registrar_entrada',
    'registrar_saida',
    'registrar_ocorrencia',
    'cadastrar_veiculo'
);

-- Administrador (todas as permissões)
INSERT INTO perfil_permissoes (perfil_id, permissao_id)
SELECT 1, id FROM permissoes;

-- ✅ Inserção exemplo de localizações
INSERT INTO localizacoes (nome) VALUES 
('Estacionamento A'), ('Estacionamento B'), ('Estacionamento C'),
('Garagem Sede I'), ('Garagem Sede II');
