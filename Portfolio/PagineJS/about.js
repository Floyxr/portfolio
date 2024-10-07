import Layout from '../components/Layout';
import styled from 'styled-components';

const AboutSection = styled.section`
  display: flex;
  align-items: center;
  flex-direction: column;
  padding: 20px;
`;

const ProfileImage = styled.img`
  border-radius: 50%;
  width: 150px;
  height: 150px;
  margin-bottom: 20px;
`;

export default function About() {
  return (
    <Layout>
      <AboutSection>
        <ProfileImage src="/me.jpg" alt="Profile picture" />
        <h2>Chi Sono</h2>
        <p>Ciao, sono [Il tuo nome]. Sono un programmatore appassionato di sviluppo web...</p>
      </AboutSection>
    </Layout>
  );
}