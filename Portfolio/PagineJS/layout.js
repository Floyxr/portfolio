import React, { useState } from 'react';
import Link from 'next/link';
import styled from 'styled-components';

const Nav = styled.nav`
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
  background-color: #fff;
  box-shadow: 0 4px 2px -2px gray;
`;

const HamburgerMenu = styled.div`
  cursor: pointer;
  display: flex;
  flex-direction: column;
  width: 30px;
  span {
    background: #333;
    height: 3px;
    margin: 4px 0;
  }
`;

const Menu = styled.ul`
  list-style: none;
  display: ${({ open }) => (open ? 'block' : 'none')};
  position: absolute;
  top: 60px;
  left: 0;
  background-color: #fff;
  width: 100%;
  padding: 0;
  li {
    padding: 10px;
    text-align: center;
  }
`;

const Layout = ({ children }) => {
  const [open, setOpen] = useState(false);

  return (
    <>
      <Nav>
        <h1>My Portfolio</h1>
        <HamburgerMenu onClick={() => setOpen(!open)}>
          <span></span>
          <span></span>
          <span></span>
        </HamburgerMenu>
      </Nav>
      <Menu open={open}>
        <li><Link href="/">Home</Link></li>
        <li><Link href="/about">Chi Sono</Link></li>
        <li><Link href="/projects">Progetti</Link></li>
        <li><Link href="/info">Info</Link></li>
      </Menu>
      <main>{children}</main>
    </>
  );
};

export default Layout;