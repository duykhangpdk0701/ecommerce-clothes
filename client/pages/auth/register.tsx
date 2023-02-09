import RegisterTemplate from "@/components/templates/auth/register";
import Head from "next/head";
import React, { useState } from "react";
import { SubmitHandler, useForm } from "react-hook-form";
import { NextPageWithLayout } from "../_app";
import * as yup from "yup";
import { yupResolver } from "@hookform/resolvers/yup";
import { useMutation } from "react-query";
import authAPI from "@/api/authAPI";
import { useRouter } from "next/router";

export interface IRegisterParams {
  firstName: string;
  lastName: string;
  email: string;
  password: string;
  agreeCkb: boolean;
  passwordConfirmation: string;
}

const registerSchema = yup
  .object({
    firstName: yup.string().required(),
    lastName: yup.string().required(),
    email: yup.string().email().required(),
    password: yup.string().required(),
    agreeCkb: yup.boolean().required(),
    passwordConfirmation: yup.string().required(),
  })
  .required();

const Register: NextPageWithLayout = () => {
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");
  const router = useRouter();
  const {
    control,
    handleSubmit,
    formState: { errors },
  } = useForm<IRegisterParams>({
    resolver: yupResolver(registerSchema),
  });

  const registerMutation = useMutation({
    mutationKey: ["resgister"],
    mutationFn: ({
      firstName,
      lastName,
      email,
      password,
      agreeCkb,
      passwordConfirmation,
    }: IRegisterParams) => {
      setLoading(true);
      return authAPI.register(
        firstName,
        lastName,
        email,
        password,
        agreeCkb,
        passwordConfirmation
      );
    },
    onSuccess: async (data) => {
      await router.push("/auth/login");
      setLoading(false);
    },
    onError: (error: any) => {
      console.log(error);
      setError(error.message);
      setLoading(false);
    },
  });

  const onSubmit: SubmitHandler<IRegisterParams> = (data) => {
    const {
      firstName,
      lastName,
      email,
      password,
      agreeCkb,
      passwordConfirmation,
    } = data;
    registerMutation.mutate({
      firstName,
      lastName,
      email,
      password,
      agreeCkb,
      passwordConfirmation,
    });
  };
  return (
    <>
      <Head>
        <title>Register | DBRR Store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <RegisterTemplate
        isLoading={loading}
        control={control}
        handleSubmit={handleSubmit}
        onSubmit={onSubmit}
        errors={errors}
        errorResMessage={error}
      />
    </>
  );
};

export default Register;
