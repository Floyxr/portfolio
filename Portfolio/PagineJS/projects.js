import Layout from '../components/Layout';
import styled from 'styled-components';

const ProjectCard = styled.div`
  border: 1px solid #ddd;
  padding: 20px;
  margin: 10px;
  border-radius: 10px;
`;

export default function Projects() {
  return (
    <Layout>
      <section>
        <h2>Progetti</h2>
        <ProjectCard>
          <h3>Nome Progetto 1</h3>
          <p>Descrizione del progetto...</p>
        </ProjectCard>
        <ProjectCard>
          <h3>Nome Progetto 2</h3>
          <p>Descrizione del progetto...</p>
        </ProjectCard>
      </section>
    </Layout>
  );
}