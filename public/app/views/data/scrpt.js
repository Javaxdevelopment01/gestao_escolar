// 1. Dataset de exemplo (no teu projeto, carrega o JSON com 10.000 perguntas)
const dataset = {
  "Como posso lançar as notas dos alunos?": "Vá ao menu 'Notas', selecione turma e disciplina, insira e salve."
  // … restante do dataset
};

// 2. Função de fallback que chama a API da OpenAI
async function pesquisarFallback(pergunta) {
  const endpoint = "https://api.openai.com/v1/chat/completions";
  const OPENAI_API_KEY = process.env.OPENAI_API_KEY; // variável de ambiente

  const body = {
    model: "gpt-3.5-turbo",
    messages: [
      { role: "system", content: "Você é assistente de um sistema escolar. Responda de forma clara e direta." },
      { role: "user", content: pergunta }
    ],
    temperature: 0.7,
    max_tokens: 150
  };

  try {
    const res = await fetch(endpoint, {
      headers: {
        "Content-Type": "application/json",
        "Authorization": `Bearer ${OPENAI_API_KEY}`
      },
      method: "POST",
      body: JSON.stringify(body)
    });

    if (!res.ok) {
      console.error("Erro na API OpenAI:", res.status, await res.text());
      return "Desculpa, erro ao consultar a IA.";
    }

    const data = await res.json();
    return data.choices[0]?.message?.content.trim() || "Nenhuma resposta válida recebida.";
  } catch (err) {
    console.error("Exceção ao chamar a API:", err);
    return "Desculpa, falha ao consultar a IA.";
  }
}

// 3. Função principal que responde à pergunta
async function responderPergunta(pergunta) {
  if (dataset[pergunta]) {
    return dataset[pergunta];
  } else {
    console.log("Pergunta não encontrada no dataset. Consultando IA...");
    return await pesquisarFallback(pergunta);
  }
}

// 4. Exemplo de uso
(async () => {
  const p1 = "Onde vejo o horário das minhas aulas?";
  console.log("Resposta:", await responderPergunta(p1));

  const p2 = "Qual é o calendário escolar deste ano?";
  console.log("Resposta (via IA):", await responderPergunta(p2));
})();
