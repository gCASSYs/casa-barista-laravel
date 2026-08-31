---
version: alpha
name: "Casa do Barista"
description: "Painel administrativo com a identidade artesanal, acolhedora e brasileira do site Casa do Barista."
colors:
  espresso: "#4B2E1E"
  coffee: "#8B5E3C"
  caramel: "#B56A34"
  olive: "#5C6945"
  cream: "#F3E8D6"
  black: "#0B0B0B"
  light-background: "#EEE3D2"
  light-surface: "#FFFAF2"
  dark-background: "#160F0C"
  dark-surface: "#241813"
typography:
  display:
    fontFamily: "Geometry Soft Pro, Trebuchet MS, sans-serif"
  body:
    fontFamily: "Bebas Neue, system-ui, sans-serif"
rounded:
  DEFAULT: "0.55rem"
  card: "0.8rem"
spacing:
  control: "0.65rem"
  panel: "1rem"
  section: "1.5rem"
components:
  navigation: {}
  card: {}
  table: {}
  button: {}
  field: {}
  dialog: {}
---

# Casa do Barista Design System

## Overview

O painel deve parecer a área de trabalho interna da mesma cafeteria apresentada no site público. A referência é o balcão da Casa do Barista: madeira espresso como estrutura, creme como superfície de trabalho, caramelo nos pontos de interação e verde oliva apenas para estados positivos.

O público é a equipe administrativa brasileira, usando principalmente desktop para consultar e manter produtos, vendas, clientes e conteúdo do site. O registro é de produto: a marca permanece reconhecível, mas tabelas, formulários e ações priorizam leitura e eficiência. A assinatura visual é o contraste entre a navegação espresso e as superfícies creme. Evitar azul corporativo genérico, gradientes decorativos em excesso e tipografia de exibição em tamanhos que prejudiquem dados.

O idioma da interface é `pt-BR`. Os tokens em `public/admin/css/style.css` são a fonte canônica em tempo de execução; este documento espelha os valores aceitos e registra sua intenção.

## Colors

No tema claro, `light-background` separa a página de `light-surface`; títulos usam `espresso`, ações usam café/caramelo e o texto permanece marrom-escuro. No tema escuro, `dark-background` e `dark-surface` substituem as superfícies sem mudar o significado das ações. `olive` é reservado para sucesso. O foco usa caramelo com contorno visível e o modo de alto contraste devolve controles ao sistema.

## Typography

Geometry Soft Pro é usada em títulos, cabeçalhos de tabela e identidade. Bebas Neue é usada em controles, dados e texto curto, sempre em tamanhos moderados no painel. Fontes de sistema são fallback. Valores monetários e contagens devem permanecer legíveis e sem efeitos decorativos.

## Layout

A navegação lateral é a âncora escura permanente em desktop; o conteúdo usa largura fluida do AdminLTE. O ritmo base é compacto: controles com cerca de `0.65rem`, painéis com `1rem` e separação de seções com `1.5rem`. Tabelas mantêm rolagem horizontal em telas estreitas e os controles do cabeçalho passam a ocupar uma linha inteira no celular.

## Elevation & Depth

A hierarquia combina contraste tonal, borda quente e sombra discreta. Cards e métricas podem ter uma sombra única; tabelas, campos e elementos internos não recebem sombras adicionais. No tema escuro, a sombra fica mais profunda e as bordas ficam mais visíveis.

## Shapes

Controles usam raio de `0.55rem` e cards `0.8rem`. Badges podem ser mais compactos, mas botões comuns não devem virar pílulas. Ícones seguem Bootstrap Icons e permanecem alinhados a rótulos textuais quando a ação não é universal.

## Components

Botões primários usam café e escurecem ou clareiam no hover conforme o tema. Foco nunca depende apenas de cor. Cards usam a superfície semântica do tema. Tabelas têm cabeçalho Geometry, linhas legíveis e hover caramelo suave. Campos preservam a aparência nativa acessível, com borda e foco da marca. Modais usam as mesmas superfícies e mantêm ações perigosas semanticamente vermelhas.

A navegação ativa usa café/caramelo e `aria-current`; hover não é o único indicador. Movimento é curto, funcional e removido por `prefers-reduced-motion`. Textos e ações devem permanecer em português claro.

## Do's and Don'ts

- **Faça:** consumir as variáveis semânticas de `admin/css/style.css` para que claro e escuro permaneçam sincronizados.
- **Faça:** reservar Geometry para hierarquia e Bebas para conteúdo operacional compacto.
- **Não faça:** copiar os tamanhos grandes das seções promocionais do site para tabelas ou modais.
- **Não faça:** adicionar cores cruas ou `!important` locais quando já existir um token compartilhado.
