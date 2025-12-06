// Dados de exemplo com cores fixas
const alunos = {
  labels:['Leonel Amaralo','Domingos','Gabriel','Ernesto','Aguinaldo Arnaldo'],
  data:[95,90,88,85,92],
  colors:['#f39c12','#e74c3c','#3498db','#2ecc71','#9b59b6']
};

const professores = {
  labels:['Silva','Costa','Lima','Alves','Santos'],
  data:[92,89,87,94,90],
  colors:['#1abc9c','#e67e22','#9b59b6','#2980b9','#e74c3c']
};

const diretores = {
  labels:['Diretor 1','Diretor 2','Diretor 3','Diretor 4','Diretor 5'],
  data:[97,93,95,96,94],
  colors:['#f1c40f','#2ecc71','#e74c3c','#3498db','#9b59b6']
};

const outros = {
  labels:['Segurança 1','Segurança 2','Limpeza 1','Limpeza 2','Admin'],
  data:[88,91,85,87,90],
  colors:['#e67e22','#1abc9c','#2ecc71','#3498db','#9b59b6']
};

// Função para criar gráfico Doughnut
function criarDoughnut(id, dataset){
  new Chart(document.getElementById(id), {
    type:'doughnut',
    data:{
      labels: dataset.labels,
      datasets:[{
        data: dataset.data,
        backgroundColor: dataset.colors,
        borderWidth: 2,
        borderColor:'#fff',
        hoverOffset: 15
      }]
    },
    options:{
      responsive:true,
      plugins:{
        legend:{
          position:'bottom',
          labels:{ color:'#2c3e50', font:{size:14} }
        },
        tooltip:{
          callbacks:{
            label:function(context){
              return context.label + ': ' + context.raw + '%';
            }
          }
        }
      },
      animation:{
        animateRotate:true,
        animateScale:true,
        duration:1500,
        easing:'easeOutBounce'
      }
    }
  });
}

// Criar todos os gráficos
criarDoughnut('alunosChart', alunos);
criarDoughnut('professoresChart', professores);
criarDoughnut('diretoresChart', diretores);
criarDoughnut('outrosChart', outros);

// Identificar os melhores
function melhor(labels, data){
  return labels[data.indexOf(Math.max(...data))];
}

const divMelhores = document.createElement('div');
divMelhores.classList.add('melhores');
divMelhores.style.marginTop = '20px';
divMelhores.innerHTML = `
  <h2>Melhores Desempenhos</h2>
  <p><strong>Melhor Aluno:</strong> ${melhor(alunos.labels, alunos.data)}</p>
  <p><strong>Melhor Professor:</strong> ${melhor(professores.labels, professores.data)}</p>
  <p><strong>Melhor Diretor:</strong> ${melhor(diretores.labels, diretores.data)}</p>
  <p><strong>Melhor Segurança:</strong> ${outros.labels[0]}</p>
  <p><strong>Melhor Funcionário da Limpeza:</strong> ${outros.labels[2]}</p>
`;
document.querySelector('.charts-container').after(divMelhores);
