<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Service",
    "serviceType": "Criação de Sites para Psicólogos",
    "provider": {
        "@type": "Organization",
        "name": "Psicólogos Especialistas",
        "url": "<?php echo BASE_URL; ?>",
        "logo": "<?php echo IMAGE_PATH; ?>/logo-psicologos-especialistas.png"
    },
    "areaServed": "Brasil",
    "description": "Desenvolvimento de sites e landing pages especializadas para psicólogos com foco em conversão e captação de pacientes.",
    "offers": {
        "@type": "Offer",
        "price": "Consultar",
        "priceCurrency": "BRL"
    }
}
</script>

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "Site para Psicólogo - Páginas Profissionais e Landing Pages",
    "description": "Desenvolvimento de sites e landing pages especializadas para psicólogos. Atraia mais pacientes com um site otimizado e com design focado em conversão.",
    "url": "<?php echo SITE_URL; ?>/index",
    "breadcrumb": {
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "Início",
                "item": "<?php echo BASE_URL; ?>/"
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "Site para Psicólogos",
                "item": "<?php echo SITE_URL; ?>/index"
            }
        ]
    },
    "primaryImageOfPage": {
        "@type": "ImageObject",
        "url": "<?php echo IMAGE_PATH; ?>/logo-psicologos-especialistas.webp",
        "width": "1200",
        "height": "630",
        "caption": "Psicólogos Especialistas - Criação de Sites para Psicólogos"
    },
    "mainEntity": {
        "@type": "Organization",
        "name": "Psicólogos Especialistas",
        "url": "<?php echo BASE_URL; ?>",
        "logo": {
            "@type": "ImageObject",
            "url": "<?php echo IMAGE_PATH; ?>/logo-psicologos-especialistas.webp"
        },
        "description": "Agência especializada em desenvolvimento de sites e landing pages para psicólogos, com foco em captação de pacientes e presença digital.",
        "contactPoint": {
            "@type": "ContactPoint",
            "contactType": "WhatsApp",
            "url": "https://wa.me/<?php echo SITE_WHATSAPP; ?>?text=Olá! Gostaria de saber mais sobre os sites para psicólogos.",
            "availableLanguage": ["Portuguese"]
        },
        "sameAs": [
            "<?php echo INSTAGRAM_URL; ?>",
            "<?php echo YOUTUBE_URL; ?>"
            
        ]
    }
}
</script>

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "ItemList",
    "name": "Diferenciais da Agência Especializada em Psicologia",
    "description": "Motivos para escolher uma agência especializada em sites para psicólogos, com foco em ética, agendamento e performance.",
    "itemListElement": [
        {
            "@type": "ListItem",
            "position": 1,
            "item": {
                "@type": "Service",
                "name": "Conformidade com o CFP",
                "description": "Layouts e estruturas desenvolvidos respeitando integralmente o Código de Ética Profissional do Psicólogo (Resolução CFP), garantindo uma divulgação segura e respeitosa.",
                "serviceType": "Desenvolvimento de Sites para Psicólogos",
                "provider": {
                    "@type": "Organization",
                    "name": "Psicólogos Especialistas"
                },
                "areaServed": "Brasil",
                "audience": {
                    "@type": "Audience",
                    "audienceType": "Psicólogos e Clínicas de Psicologia"
                }
            }
        },
        {
            "@type": "ListItem",
            "position": 2,
            "item": {
                "@type": "Service",
                "name": "Agendamento Direto no WhatsApp",
                "description": "Integração de botões estratégicos de contato e formulários intuitivos que facilitam o agendamento de consultas presenciais ou atendimento psicoterápico online.",
                "serviceType": "Integração com WhatsApp",
                "provider": {
                    "@type": "Organization",
                    "name": "Psicólogos Especialistas"
                },
                "areaServed": "Brasil",
                "audience": {
                    "@type": "Audience",
                    "audienceType": "Pacientes de Psicologia"
                }
            }
        },
        {
            "@type": "ListItem",
            "position": 3,
            "item": {
                "@type": "Service",
                "name": "Velocidade e Segurança SSL",
                "description": "Páginas leves que carregam em menos de 2 segundos no celular, acompanhadas de certificado de segurança para proteger a navegação do seu futuro paciente.",
                "serviceType": "Hospedagem e Segurança Web",
                "provider": {
                    "@type": "Organization",
                    "name": "Psicólogos Especialistas"
                },
                "areaServed": "Brasil",
                "offers": {
                    "@type": "Offer",
                    "description": "Site com carregamento rápido e certificado SSL incluso",
                    "availability": "https://schema.org/InStock",
                    "priceCurrency": "BRL"
                }
            }
        }
    ]
}
</script>

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@graph": [
        {
            "@type": "ProfessionalService",
            "@id": "<?php echo BASE_URL; ?>/#organization",
            "name": "Psicólogos Especialistas - Criação de Sites para Psicólogos",
            "url": "<?php echo BASE_URL; ?>",
            "logo": "<?php echo IMAGE_PATH; ?>/logo-psicologos-especialistas.webp",
            "description": "Desenvolvimento de sites e landing pages especializadas para psicólogos e terapeutas com otimização SEO e conformidade ética CFP.",
            "telephone": "<?php echo SITE_PHONE; ?>",
            "areaServed": {
                "@type": "Country",
                "name": "Brasil"
            },
            "hasOfferCatalog": {
                "@type": "OfferCatalog",
                "name": "Serviços de Criação Web para Psicologia",
                "itemListElement": [
                    {
                        "@type": "Offer",
                        "itemOffered": {
                            "@type": "Service",
                            "name": "Landing Page para Psicólogos",
                            "description": "Páginas de alta conversão para psicólogos focadas em captação de pacientes para atendimento presencial e online."
                        }
                    },
                    {
                        "@type": "Offer",
                        "itemOffered": {
                            "@type": "Service",
                            "name": "Site Institucional para Psicólogos",
                            "description": "Desenvolvimento de site completo com blog, apresentação profissional e sistema de agendamento."
                        }
                    },
                    {
                        "@type": "Offer",
                        "itemOffered": {
                            "@type": "Service",
                            "name": "SEO para Psicólogos",
                            "description": "Otimização nos motores de busca para posicionar o site de psicologia nas primeiras páginas do Google."
                        }
                    }
                ]
            }
        },
        {
            "@type": "FAQPage",
            "mainEntity": [
                {
                    "@type": "Question",
                    "name": "O site é feito de acordo com as regras do CFP?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Sim! Todo o design, textos e chamadas de ação são estruturados em estrita conformidade com o Código de Ética do Conselho Federal de Psicologia."
                    }
                },
                {
                    "@type": "Question",
                    "name": "Qual a diferença entre um Site e uma Landing Page?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Uma Landing Page é focada em conversão direta para campanhas pagas (Google Ads). Um Site Institucional conta com mais páginas para autoridade a longo prazo."
                    }
                },
                {
                    "@type": "Question",
                    "name": "Em quanto tempo meu site fica pronto?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "O prazo médio para entrega de uma Landing Page é de 5 a 7 dias úteis."
                    }
                }
            ]
        }
    ]
}
</script>