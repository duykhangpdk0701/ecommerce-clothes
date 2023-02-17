import React, { ReactElement, useState } from "react";
import { SubmitHandler, useForm } from "react-hook-form";
import { useMutation } from "react-query";
import { NextPageWithLayout } from "../../_app";
import * as yup from "yup";
import { useRouter } from "next/router";
import { yupResolver } from "@hookform/resolvers/yup";
import Head from "next/head";
import CreateCategoryTemplate from "@/components/templates/admin/category/CreateCategory";
import AdminLayout from "@/layout/AdminLayout";
import categoryAPI from "@/api/categoryAPI";

export interface ICreateBrandParams {
  name: string;
  slug: string;
  status: boolean;
  order: string;
}

const createBrandSchema = yup.object({
  name: yup.string().required(),
  slug: yup.string().required(),
  status: yup.boolean().required(),
  order: yup.string().required(),
});

const CreateAdminItemCategory: NextPageWithLayout = () => {
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
      return categoryAPI.getListOfCategory();
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
      <CreateCategoryTemplate
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

CreateAdminItemCategory.getLayout = function getLayout(page: ReactElement) {
  return <AdminLayout>{page}</AdminLayout>;
};

export default CreateAdminItemCategory;
