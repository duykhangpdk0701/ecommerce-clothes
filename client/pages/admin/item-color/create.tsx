import CreateItemColorTemplate from "@/components/templates/admin/itemColor/create";
import AdminLayout from "@/layout/AdminLayout";
import Head from "next/head";
import React, { ReactElement, useState } from "react";
import { NextPageWithLayout } from "../../_app";
import * as yup from "yup";
import { useRouter } from "next/router";
import { yupResolver } from "@hookform/resolvers/yup";
import { useMutation, useQuery } from "react-query";
import { SubmitHandler, useForm } from "react-hook-form";
import adminItemColorAPI from "@/api/admin/adminItemColor";

export interface ICreateItemColorParams {
  name: string;
  color: string;
  status: boolean;
  order: number;
}

const createItemColorSchema = yup.object({
  name: yup.string().required(),
  color: yup.string().required(),
  status: yup.boolean().required(),
  order: yup.string().required(),
});

const CreateItemColor: NextPageWithLayout = () => {
  const router = useRouter();
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");

  const {
    control,
    handleSubmit,
    formState: { errors },
  } = useForm<ICreateItemColorParams>({
    defaultValues: {
      order: 0,
      status: true,
    },
    resolver: yupResolver(createItemColorSchema),
  });

  const createItemColorMutation = useMutation({
    mutationKey: "brand",
    mutationFn: ({ name, color, order, status }: ICreateItemColorParams) => {
      setLoading(true);
      return adminItemColorAPI.createItemColor(name, color, order);
    },
    onSuccess: (data) => {
      console.log(data);
      setLoading(false);
    },
    onError: (error: any) => {
      console.log(error);
      setLoading(false);
    },
  });

  const onSubmit: SubmitHandler<ICreateItemColorParams> = (data) => {
    const { name, color, order, status } = data;
    createItemColorMutation.mutate({ name, color, order, status });
  };

  return (
    <>
      <Head>
        <title>Item Color Management | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <CreateItemColorTemplate
        control={control}
        handleSubmit={handleSubmit}
        onSubmit={onSubmit}
        errors={errors}
        isLoading={loading}
        errorResMessage={error}
      />
    </>
  );
};

CreateItemColor.getLayout = function getLayout(page: ReactElement) {
  return <AdminLayout>{page}</AdminLayout>;
};

export default CreateItemColor;
