import HomeTemplate from "@/components/templates/Home";
import HomeLayout from "@/layout/HomeLayout";
import Head from "next/head";
import { ReactElement } from "react";

const Home = () => {
  return (
    <>
      <Head>
        <title>HOME | DBRR Store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <HomeTemplate />
    </>
  );
};

Home.getLayout = function getLayout(page: ReactElement) {
  return <HomeLayout>{page}</HomeLayout>;
};

export default Home;
