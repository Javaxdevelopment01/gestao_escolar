async function fetchComRobustez(url, opcoes = {}, timeout = 10000) {
    const controlador = new AbortController();
    const idTimeout = setTimeout(() => controlador.abort(), timeout);
  
    try {
      const resposta = await fetch(url, {
        ...opcoes,
        signal: controlador.signal,
        headers: {
          'Content-Type': 'application/json',
          ...opcoes.headers
        }
      });
  
      clearTimeout(idTimeout);
  
      // Verifica se o status HTTP está OK (200)
      if (!resposta.ok) {
        throw new Error(`Erro HTTP: ${resposta.status} - ${resposta.statusText}`);
      }
  
      // Tenta converter a resposta para JSON
      const conteudoTipo = resposta.headers.get("content-type");
      if (conteudoTipo && conteudoTipo.includes("application/json")) {
        return await resposta.json();
      } else {
        return await resposta.text(); // fallback
      }
    } catch (erro) {
      if (erro.name === "AbortError") {
        console.error("Requisição cancelada por timeout.");
      } else {
        console.error("Erro na requisição:", erro.message);
      }
      throw new Error("Erro:"+erro); // repropaga o erro para quem chamou
    }
  }
  export {fetchComRobustez};
 /* fetchComRobustez("https://jsonplaceholder.typicode.com/posts", {
    method: "POST",
    body: JSON.stringify({
      title: "Título de Teste",
      body: "Conteúdo do post",
      userId: 1
    })
  })
  .then(data => console.log("✅ Criado:", data))
  .catch(err => console.log("❗Erro:", err.message));
  fetchComRobustez("https://jsonplaceholder.typicode.com/posts/1")
  .then(data => console.log("📄 Dados recebidos:", data))
  .catch(err => console.log("❗Erro:", err.message));

*/
