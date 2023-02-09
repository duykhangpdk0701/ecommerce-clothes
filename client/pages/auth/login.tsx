import authAPI from "@/api/authAPI";
import LoginTemplate from "@/components/templates/auth/login";
import Head from "next/head";
import React, { useState } from "react";
import { SubmitHandler, useForm } from "react-hook-form";
import { useMutation } from "react-query";
import { NextPageWithLayout } from "../_app";
import * as yup from "yup";
import { yupResolver } from "@hookform/resolvers/yup";
import { Router, useRouter } from "next/router";

export interface ILoginParams {
  email: string;
  password: string;
}

const loginSchema = yup
  .object({
    email: yup.string().required(),
    password: yup.string().required(),
  })
  .required();

const Login: NextPageWithLayout = () => {
  const router = useRouter();
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");

  const {
    control,
    handleSubmit,
    formState: { errors },
  } = useForm<ILoginParams>({
    defaultValues: {
      email: "",
      password: "",
    },
    resolver: yupResolver(loginSchema),
  });

  const loginMutation = useMutation({
    mutationKey: ["login"],
    mutationFn: ({ email, password }: ILoginParams) => {
      setLoading(true);

      return authAPI.login(email, password);
    },
    onSuccess: async (data) => {
      await router.push("/");
      setLoading(false);
    },
    onError: (error: any) => {
      setError(error.message);
      setLoading(false);
    },
  });

  const onSubmit: SubmitHandler<ILoginParams> = (data) => {
    const { email, password } = data;
    loginMutation.mutate({ email, password });
  };

  return (
    <>
      <Head>
        <title>Login | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <LoginTemplate
        errorResMessage={error}
        isLoading={loading}
        control={control}
        handleSubmit={handleSubmit}
        onSubmit={onSubmit}
        errors={errors}
      />
    </>
  );
};

export default Login;
