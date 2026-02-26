# PopUpJSClient - Pop-ups Profissionais para WHMCS 🚀

Readme: [English](README.md)

![License](https://img.shields.io/github/license/sr00t3d/PopUpJSClient)
![PHP Script](https://img.shields.io/badge/php-script-green)
![PHP Script](https://img.shields.io/badge/javascript-script-green)

<img src="popupjsclient-cover.wepb" width="700">

O **PopUpJSClient** é um módulo addon para WHMCS que permite aos administradores criar, gerir e exibir anúncios de forma elegante através de pop-ups na área do cliente. Ideal para avisos urgentes, promoções sazonais ou atualizações de serviço.

## ✨ Funcionalidades Principais

- **Gestão Simplificada**: Interface intuitiva no painel administrativo do WHMCS para criar, editar e excluir anúncios.
- **Suporte Multimédia**: Criação de anúncios ricos com suporte para imagens e links personalizados.
- **Segmentação por Grupo**: Exiba anúncios específicos apenas para determinados grupos de clientes.
- **Sistema de Prioridades**: Garante que as informações críticas sejam visualizadas primeiro.
- **Agendamento Automático**: Define datas de início e expiração para automatizar as suas campanhas.
- **Multilíngue**: Suporte nativo para Português (BR), Inglês, Espanhol e Farsi.
- **Design Responsivo**: Pop-ups optimizados para desktop e dispositivos móveis.

## 🔥 O que há de novo

Esta versão estendida inclui melhorias críticas para uso profissional:
- **Deteção de Conteúdo Inteligente**: Identifica automaticamente se o conteúdo é texto ou imagem para uma renderização perfeita.
- **Controle de Exibição (Dismiss 24h)**: Implementação de cookies para que o cliente não seja incomodado pelo mesmo pop-up durante 24 horas após fechá-lo.
- **Padronização de Idioma**: Correções na lógica de deteção de idioma para alinhar com os padrões globais do WHMCS.
- **Upgrade Visual**: Melhorias na interface do modal com novas cores, efeitos de transição e tabelas seguindo o estilo nativo do WHMCS.
- **URLs Personalizadas**: Suporte para links externos em anúncios de imagem ou texto (Recomendado: Imagens em 800x600).

## 🚀 Instalação

1 **Clonar o Repositório:**

```bash
git clone https://github.com/sr00t3d/PopUpJSClient/`
```

2 Upload de Ficheiros: Copie o conteúdo da pasta `modules/addons/popupjsclient` para o diretório correspondente na sua instalação do WHMCS.

3 Ativação:
- Vá ao Admin do WHMCS em **Ajustes** > **Addons** > **Módulos Addon**.
- Localize o **PopUpJSClient** e clique em **Ativar**.
- Configure as permissões de acesso para os cargos administrativos desejados.

## 📁 Estrutura de Ficheiros (Padrão Laravel)

O projeto utiliza uma organização moderna para facilitar a manutenção:

<pre><code>/modules/addons/popupjsclient
|-- lib
|   |   `-- Model.php
|   |   `-- ModuleController.php
|   |   `-- ModuleView.php
|   |
|-- resources
|   |-- lang
|   |   |-- english.php
|   |   `-- farsi.php
|   |   `-- spanish.php
|   |   `-- portuguese-br.php
|-- popupjsclient.php
|-- hooks.php
</code></pre>

# 🛠️ Requisitos
- **WHMCS**: Versão 7.0 ou superior.
- **PHP**: Versão 7.2 ou superior.

## 🤝 Contribuições e Suporte

Este projeto é um fork estendido baseado no trabalho original de **Reza Karimi**. Contribuições são bem-vindas!

- **Autor Original**: Reza Karimi
- **Melhorias e Manutenção**: Percio Andrade

## ⚠️ Aviso Legal

> [!WARNING]
> Este software é fornecido "como está". Certifique-se sempre de testar primeiro em um ambiente de desenvolvimento. O autor não se responsabiliza por qualquer uso indevido, consequências legais ou impacto em dados causado por esta ferramenta.

## 📚 Tutorial Detalhado

Para um guia completo, passo a passo, confira meu artigo completo:

👉 [**Criar janelas modais no WHMCS**](https://perciocastelo.com.br/blog/create-modal-popups-in-whmcs.html)

## Licença 📄

Este projeto está licenciado sob a **GNU General Public License v3.0**. Consulte o arquivo [LICENSE](LICENSE) para mais detalhes.
