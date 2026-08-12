<!-- Schema.org JSON-LD para Site Institucional -->
<script type="application/ld+json">
{
  "$schema": "http://json-schema.org/draft-07/schema#",
  "type": "object",
  "title": "Página de Marketing Digital para Psicólogos",
  "description": "Estrutura de dados para a página de guia de marketing digital para psicólogos",
  "properties": {
    "hero": {
      "type": "object",
      "title": "Hero / Header da Página",
      "description": "Seção principal de cabeçalho com o título e chamada para ação",
      "properties": {
        "badge": {
          "type": "string",
          "description": "Badge de identificação do conteúdo",
          "example": "Guia de Marketing Digital para Psicólogos"
        },
        "titulo": {
          "type": "string",
          "description": "Título principal da página",
          "example": "Como Construir uma Presença Digital Ética, Relevante e Capaz de Atrair Pacientes"
        },
        "subtitulo": {
          "type": "string",
          "description": "Descrição persuasiva sobre a presença digital",
          "example": "Descubra como transformar o conhecimento da sua prática clínica em uma vitrine profissional de alta credibilidade. Entenda os pilares para posicionar seu nome no topo das buscas do Google."
        },
        "ctas": {
          "type": "array",
          "description": "Botões de chamada para ação",
          "items": {
            "type": "object",
            "properties": {
              "texto": {
                "type": "string"
              },
              "link": {
                "type": "string"
              },
              "estilo": {
                "type": "string",
                "enum": ["primary", "secondary", "outline"]
              }
            }
          }
        },
        "card_destaque": {
          "type": "object",
          "title": "Card de Destaque",
          "description": "Card com informação relevante sobre busca por psicólogos",
          "properties": {
            "icone": {
              "type": "string",
              "description": "Emoji ou ícone representativo",
              "example": "🧠💡"
            },
            "titulo": {
              "type": "string",
              "example": "Você sabia?"
            },
            "conteudo": {
              "type": "string",
              "example": "Mais de 80% das pessoas pesquisam no Google antes de agendar a primeira consulta de psicoterapia."
            }
          }
        }
      }
    },
    "introducao": {
      "type": "object",
      "title": "Introdução Persuasiva",
      "description": "Texto introdutório sobre a importância da presença web",
      "properties": {
        "titulo": {
          "type": "string",
          "example": "A Importância de Ter um Endereço Próprio na Internet"
        },
        "paragrafos": {
          "type": "array",
          "description": "Parágrafos do texto de introdução",
          "items": {
            "type": "string"
          }
        }
      }
    },
    "pilares_seo": {
      "type": "object",
      "title": "4 Pilares SEO",
      "description": "Seção com abas mostrando os pilares de SEO para psicólogos",
      "properties": {
        "badge": {
          "type": "string",
          "example": "Estratégias Práticas"
        },
        "titulo": {
          "type": "string",
          "example": "4 Pilares SEO para Impulsionar o Site do Psicólogo"
        },
        "subtitulo": {
          "type": "string",
          "example": "Clique nas abas abaixo para entender como otimizar cada etapa da sua jornada digital."
        },
        "abas": {
          "type": "array",
          "description": "Lista de abas com seus conteúdos",
          "items": {
            "type": "object",
            "properties": {
              "id": {
                "type": "string"
              },
              "titulo": {
                "type": "string"
              },
              "icone": {
                "type": "string"
              },
              "conteudo": {
                "type": "object",
                "properties": {
                  "subtitulo": {
                    "type": "string"
                  },
                  "paragrafos": {
                    "type": "array",
                    "items": {
                      "type": "string"
                    }
                  },
                  "link": {
                    "type": "object",
                    "description": "Link opcional para landing page ou site",
                    "properties": {
                      "url": {
                        "type": "string"
                      },
                      "texto": {
                        "type": "string"
                      },
                      "target": {
                        "type": "string",
                        "default": "_blank"
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    },
    "solucoes_web": {
      "type": "object",
      "title": "Soluções Web",
      "description": "Seção comparativa entre Landing Page e Site Institucional",
      "properties": {
        "badge": {
          "type": "string",
          "example": "A Estratégia Certa"
        },
        "titulo": {
          "type": "string",
          "example": "Qual o Formato Ideal para o seu Momento Profissional?"
        },
        "descricao": {
          "type": "string",
          "example": "A escolha entre uma página de conversão rápida e um portal corporativo completo depende dos seus objetivos de curto e longo prazo na psicologia."
        },
        "opcoes": {
          "type": "array",
          "description": "Lista das opções de site",
          "items": {
            "type": "object",
            "properties": {
              "icone": {
                "type": "string"
              },
              "titulo": {
                "type": "string"
              },
              "descricao": {
                "type": "string"
              }
            }
          }
        },
        "observacao": {
          "type": "string",
          "description": "Observação final com link para tabela de valores"
        },
        "tabela_comparativa": {
          "type": "object",
          "title": "Tabela de Recursos",
          "description": "Comparação entre Landing Page e Site Completo",
          "properties": {
            "titulo": {
              "type": "string"
            },
            "linhas": {
              "type": "array",
              "items": {
                "type": "object",
                "properties": {
                  "recurso": {
                    "type": "string"
                  },
                  "landing_page": {
                    "type": "string"
                  },
                  "site_completo": {
                    "type": "string"
                  }
                }
              }
            }
          }
        }
      }
    },
    "faq": {
      "type": "object",
      "title": "Perguntas Frequentes",
      "description": "Seção de accordion com perguntas e respostas",
      "properties": {
        "titulo": {
          "type": "string",
          "example": "Perguntas Frequentes sobre Sites para Psicólogos"
        },
        "subtitulo": {
          "type": "string",
          "example": "Tire suas dúvidas técnicas e entenda como funciona a estruturação da sua presença online."
        },
        "perguntas": {
          "type": "array",
          "items": {
            "type": "object",
            "properties": {
              "id": {
                "type": "string"
              },
              "pergunta": {
                "type": "string"
              },
              "resposta": {
                "type": "string"
              }
            }
          }
        }
      }
    },
    "cta_final": {
      "type": "object",
      "title": "Chamada para Ação Final",
      "description": "Banner persuasivo no final da página",
      "properties": {
        "titulo": {
          "type": "string",
          "example": "Pronto para dar o próximo passo na sua carreira digital?"
        },
        "descricao": {
          "type": "string",
          "example": "Não deixe que potenciais pacientes fiquem sem encontrar o acolhimento que você oferece."
        },
        "botao": {
          "type": "object",
          "properties": {
            "texto": {
              "type": "string"
            },
            "link": {
              "type": "string"
            },
            "target": {
              "type": "string",
              "default": "_blank"
            }
          }
        }
      }
    }
  }
}
</script>