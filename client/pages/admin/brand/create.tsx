import adminBrandAPI from "@/api/admin/adminBrandAPI";
import CreateBrandTemplate from "@/components/templates/admin/brand/CreateBrand";
import AdminLayout from "@/layout/AdminLayout";
import Head from "next/head";
import React, { ReactElement, useState } from "react";
import { SubmitHandler, useForm } from "react-hook-form";
import { useMutation } from "react-query";
import { NextPageWithLayout } from "@/pages/_app";
import * as yup from "yup";
import { useRouter } from "next/router";
import { yupResolver } from "@hookform/resolvers/yup";
export interface ICreateBrandParams {
  name: string;
  slug: string;
  status: boolean;
  order: number;
}

const createBrandSchema = yup.object({
  name: yup.string().required(),
  slug: yup.string().required(),
  status: yup.boolean().required(),
  order: yup.string().required(),
});

const CreateBrand: NextPageWithLayout = () => {
  const router = useRouter();
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");

  const {
    control,
    handleSubmit,
    formState: { errors },
  } = useForm<ICreateBrandParams>({
    defaultValues: {
      status: true,
    },
    resolver: yupResolver(createBrandSchema),
  });

  const createBrandMutation = useMutation({
    mutationKey: "brand",
    mutationFn: ({ name, slug, order, status }: ICreateBrandParams) => {
      setLoading(true);
      return adminBrandAPI.createBrand(name, slug, order, status);
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

  const onSubmit: SubmitHandler<ICreateBrandParams> = (data) => {
    const { name, slug, order, status } = data;
    createBrandMutation.mutate({ name, slug, order, status });
  };

  return (
    <>
      <Head>
        <title>Brand Management | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <CreateBrandTemplate
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

CreateBrand.getLayout = function getLayout(page: ReactElement) {
  return <AdminLayout>{page}</AdminLayout>;
};

export default CreateBrand;
