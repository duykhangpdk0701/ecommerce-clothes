import ResetPasswordTemplate from "@/components/templates/auth/reset";
import Head from "next/head";
import React from "react";

const ResetPassword = () => {
  return (
    <>
      <Head>
        <title>Reset password | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <ResetPasswordTemplate />
    </>
  );
};

export default ResetPassword;
