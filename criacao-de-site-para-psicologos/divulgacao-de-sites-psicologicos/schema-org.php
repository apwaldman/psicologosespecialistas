<!-- Schema.org JSON-LD para Site Institucional -->
<script type="application/ld+json">
{
  "$schema": "http://json-schema.org/draft-07/schema#",
  "type": "object",
  "title": "Página de Divulgação e SEO Local para Psicólogos",
  "description": "Estrutura de dados para a página de estratégias de visibilidade local e SEO para psicólogos",
  "properties": {
    "hero": {
      "type": "object",
      "title": "Hero / Header da Página",
      "description": "Seção principal de cabeçalho com título e chamadas para ação",
      "properties": {
        "badge": {
          "type": "string",
          "description": "Badge de identificação do conteúdo",
          "example": "Estratégias de Visibilidade Local & SEO"
        },
        "titulo": {
          "type": "string",
          "description": "Título principal da página",
          "example": "Como Fazer Seu Consultório de Psicologia Ser Encontrado no Google Maps e na Web"
        },
        "subtitulo": {
          "type": "string",
          "description": "Descrição persuasiva sobre visibilidade local",
          "example": "Criar um site é apenas o primeiro passo. Descubra como posicionar seu nome na busca local, construir autoridade com backlinks estratégicos e divulgar seu consultório para atrair pacientes com consistência."
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
              "target": {
                "type": "string",
                "default": "_blank"
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
          "title": "Card de Destaque do Hero",
          "description": "Card com informação sobre Google Maps",
          "properties": {
            "icone": {
              "type": "string",
              "description": "Emoji ou ícone representativo",
              "example": "📍🗺️"
            },
            "titulo": {
              "type": "string",
              "example": "Perto de Você!"
            },
            "descricao": {
              "type": "string",
              "example": "A maioria dos pacientes pesquisa por 'Psicólogo perto de mim'. Estar ativo no Google Maps aumenta drasticamente as chamadas e agendamentos diretos."
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
    },
    "introducao_local": {
      "type": "object",
      "title": "Introdução - SEO Local",
      "description": "Seção sobre a importância do Google Maps e SEO local",
      "properties": {
        "badge": {
          "type": "string",
          "example": "SEO Local em Ação"
        },
        "titulo": {
          "type": "string",
          "example": "Por que Estar no Google Maps É Vital para o Psicólogo?"
        },
        "paragrafos": {
          "type": "array",
          "description": "Parágrafos explicativos",
          "items": {
            "type": "string"
          }
        },
        "callout": {
          "type": "object",
          "title": "Callout de Destaque",
          "description": "Box de destaque com chamada para ação",
          "properties": {
            "titulo": {
              "type": "string"
            },
            "descricao": {
              "type": "string"
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
    },
    "backlinks": {
      "type": "object",
      "title": "Backlinks e Divulgação",
      "description": "Seção sobre o poder dos backlinks e divulgação no portal",
      "properties": {
        "badge": {
          "type": "string",
          "example": "Autoridade de Domínio"
        },
        "titulo": {
          "type": "string",
          "example": "O que São Backlinks e Por que Eles Fazem Seu Site Ranquear no Google?"
        },
        "paragrafos": {
          "type": "array",
          "items": {
            "type": "string"
          }
        },
        "botao_principal": {
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
        },
        "card_beneficios": {
          "type": "object",
          "title": "Card de Benefícios",
          "description": "Card listando benefícios da divulgação",
          "properties": {
            "titulo": {
              "type": "string"
            },
            "beneficios": {
              "type": "array",
              "items": {
                "type": "object",
                "properties": {
                  "titulo": {
                    "type": "string"
                  },
                  "descricao": {
                    "type": "string"
                  }
                }
              }
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
    },
    "passos_pos_lancamento": {
      "type": "object",
      "title": "Passos Pós-Lançamento",
      "description": "Guia com passos para divulgar o site após o desenvolvimento",
      "properties": {
        "badge": {
          "type": "string",
          "example": "Guia Pós-Lançamento"
        },
        "titulo": {
          "type": "string",
          "example": "Seu Site Foi Desenvolvido pela Psicólogos Especialistas? Veja Como Divulgá-lo!"
        },
        "subtitulo": {
          "type": "string",
          "example": "Ter um site moderno e otimizado é a sua base. Agora é hora de fazê-lo circular na rede."
        },
        "passos": {
          "type": "array",
          "description": "Lista de passos com cards",
          "items": {
            "type": "object",
            "properties": {
              "numero": {
                "type": "string"
              },
              "icone": {
                "type": "string"
              },
              "titulo": {
                "type": "string"
              },
              "descricao": {
                "type": "string"
              },
              "link": {
                "type": "object",
                "properties": {
                  "texto": {
                    "type": "string"
                  },
                  "url": {
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
    },
    "tabela_solucoes": {
      "type": "object",
      "title": "Tabela de Soluções",
      "description": "Tabela comparativa de soluções de divulgação",
      "properties": {
        "badge": {
          "type": "string",
          "example": "Estratégia Combinada"
        },
        "titulo": {
          "type": "string",
          "example": "A Sinergia Perfeita para Atrair Pacientes"
        },
        "paragrafos": {
          "type": "array",
          "items": {
            "type": "string"
          }
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
        },
        "linhas_tabela": {
          "type": "array",
          "description": "Linhas da tabela comparativa",
          "items": {
            "type": "object",
            "properties": {
              "solucao": {
                "type": "string"
              },
              "objetivo": {
                "type": "string"
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
    },
    "faq_divulgacao": {
      "type": "object",
      "title": "FAQ - Perguntas Frequentes",
      "description": "Seção de perguntas frequentes sobre divulgação e SEO local",
      "properties": {
        "titulo": {
          "type": "string",
          "example": "Dúvidas Frequentes sobre Divulgação e SEO Local"
        },
        "subtitulo": {
          "type": "string",
          "example": "Esclareça os aspectos práticos da promoção do seu site de psicologia."
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
              },
              "links": {
                "type": "array",
                "description": "Links inseridos na resposta",
                "items": {
                  "type": "object",
                  "properties": {
                    "texto": {
                      "type": "string"
                    },
                    "url": {
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
    },
    "cta_final_divulgacao": {
      "type": "object",
      "title": "Chamada para Ação Final",
      "description": "Banner final com CTA para divulgação",
      "properties": {
        "titulo": {
          "type": "string",
          "example": "Acelere a Visibilidade do Seu Consultório Hoje Mesmo"
        },
        "descricao": {
          "type": "string",
          "example": "Combine a criação de um site de alta performance com estratégias de SEO local e backlinks no maior portal especializado."
        },
        "botoes": {
          "type": "array",
          "items": {
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
              },
              "estilo": {
                "type": "string",
                "enum": ["light", "outline-light"]
              }
            }
          }
        }
      }
    }
  }
}
</script>