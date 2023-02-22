import CreateProductTemplate from "@/components/templates/admin/product/CreateProduct";
import AdminLayout from "@/layout/AdminLayout";
import Head from "next/head";
import { useRouter } from "next/router";
import React, { ReactElement, useState } from "react";
import { NextPageWithLayout } from "../../_app";
import { SubmitHandler, useForm } from "react-hook-form";
import { yupResolver } from "@hookform/resolvers/yup";
import * as yup from "yup";

export interface ICreateProductParams {
  name: string;
  sku: string;
  description: string;
  brandId: number;
  itemCategoriesId: number[];
  thumbnailImage: string;
  detailImages: string;
  itemPersonTypeId: number;
  itemStockStatusId: number;
  itemSizes: number[];
  itemColors: number[];
  status: boolean;
}

const createBrandSchema = yup.object({
  name: yup.string().required(),
  sku: yup.string().required(),
  description: yup.string(),
  brandId: yup.number().required(),
  itemCategoriesId: yup.array().required(),
  detailImages: yup.array().required(),
  itemPersonTypeId: yup.number().required(),
  itemStockStatusId: yup.number().required(),
  itemSizes: yup.array().required(),
  itemColors: yup.array().required(),
  status: yup.boolean().required(),
});

const CreateProduct: NextPageWithLayout = () => {
  const router = useRouter();
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");

  const {
    control,
    handleSubmit,
    formState: { errors },
  } = useForm<ICreateProductParams>({
    defaultValues: {
      status: true,
    },
    resolver: yupResolver(createBrandSchema),
  });

  const onSubmit: SubmitHandler<ICreateProductParams> = (data) => {
    const {} = data;
    console.log(data);
  };

  return (
    <>
      <Head>
        <title>Product Management | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <CreateProductTemplate
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

CreateProduct.getLayout = function getLayout(page: ReactElement) {
  return <AdminLayout>{page}</AdminLayout>;
};

export default CreateProduct;
