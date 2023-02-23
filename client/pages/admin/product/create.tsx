import CreateProductTemplate from "@/components/templates/admin/product/CreateProduct";
import AdminLayout from "@/layout/AdminLayout";
import Head from "next/head";
import { useRouter } from "next/router";
import React, { ReactElement, useState } from "react";
import { NextPageWithLayout } from "../../_app";
import { SubmitHandler, useForm } from "react-hook-form";
import { yupResolver } from "@hookform/resolvers/yup";
import * as yup from "yup";
import { useMutation, useQuery } from "react-query";
import adminItemSizeAPI from "@/api/admin/adminItemSize";
import adminItemColorAPI from "@/api/admin/adminItemColor";
import adminItemCategoryAPI from "@/api/admin/adminItemCategoryAPI";
import adminBrandAPI from "@/api/admin/adminBrandAPI";
import adminItemAPI from "@/api/admin/adminItemAPI";
import { setSnackbar } from "@/contexts/slices/snackbarSlice";
import { useAppDispatch } from "@/hooks/redux";

export interface ICreateProductParams {
  name: string;
  sku: string;
  description: string;
  brandId: number;
  itemCategoriesId: number[];
  thumbnailImage: File;
  detailImages: File[];
  itemPersonTypeId: number;
  itemStockStatusId: number;
  itemSizes: number[];
  itemColors: number[];
  status: boolean;
}

const createBrandSchema = yup.object({
  name: yup.string().required(),
  sku: yup.string().required(),
  description: yup.string().required(),
  brandId: yup.number().required(),
  itemCategoriesId: yup.array().min(1).required(),
  thumbnailImage: yup.mixed().required(),
  detailImages: yup.array().min(1).required(),
  itemPersonTypeId: yup.number().required(),
  // itemStockStatusId: yup.number().required(),
  itemSizes: yup.array().min(1).required(),
  itemColors: yup.array().min(1).required(),
  status: yup.boolean().required(),
});

const CreateProduct: NextPageWithLayout = () => {
  const router = useRouter();
  const dispatch = useAppDispatch();
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");

  const itemSizeQuery = useQuery({
    queryKey: "item-size",
    queryFn: () => adminItemSizeAPI.getListOfItemSize(),
  });

  const itemColorQuery = useQuery({
    queryKey: "item-color",
    queryFn: () => adminItemColorAPI.getListOfItemColor(),
  });

  const itemCategoryQuery = useQuery({
    queryKey: "item-category",
    queryFn: () => adminItemCategoryAPI.getListOfItemCategory(),
  });

  const brandQuery = useQuery({
    queryKey: "brand",
    queryFn: () => adminBrandAPI.getListOfBrand(),
  });

  const createItemMutation = useMutation({
    mutationKey: "item",
    mutationFn: ({
      name,
      sku,
      description,
      brandId,
      itemCategoriesId,
      thumbnailImage,
      detailImages,
      itemPersonTypeId,
      itemStockStatusId,
      itemSizes,
      itemColors,
      status,
    }: ICreateProductParams) =>
      adminItemAPI.createItem(
        name,
        sku,
        description,
        brandId,
        itemCategoriesId,
        thumbnailImage,
        detailImages,
        itemPersonTypeId,
        itemStockStatusId,
        itemSizes,
        itemColors,
        status
      ),
    onSuccess: () => {
      dispatch(
        setSnackbar({
          snackbarOpen: true,
          snackbarType: "success",
          snackbarMessage: "Xử lý thành công",
        })
      );
    },
    onError: () => {
      dispatch(
        setSnackbar({
          snackbarOpen: true,
          snackbarType: "error",
          snackbarMessage: "Xử lý không thành công",
        })
      );
    },
  });

  const {
    control,
    handleSubmit,
    formState: { errors },
  } = useForm<ICreateProductParams>({
    defaultValues: {
      status: true,
      itemCategoriesId: [],
      itemColors: [],
      itemSizes: [],
    },
    resolver: yupResolver(createBrandSchema),
  });

  const onSubmit: SubmitHandler<ICreateProductParams> = (data) => {
    const {
      name,
      sku,
      description,
      brandId,
      itemCategoriesId,
      thumbnailImage,
      detailImages,
      itemPersonTypeId,
      itemStockStatusId,
      itemSizes,
      itemColors,
      status,
    } = data;

    createItemMutation.mutate({
      name,
      sku,
      description,
      brandId,
      itemCategoriesId,
      thumbnailImage,
      detailImages,
      itemPersonTypeId,
      itemStockStatusId,
      itemSizes,
      itemColors,
      status,
    });

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
        itemCategroies={itemCategoryQuery.data}
        brand={brandQuery.data}
        itemColor={itemColorQuery.data}
        itemSize={itemSizeQuery.data}
      />
    </>
  );
};

CreateProduct.getLayout = function getLayout(page: ReactElement) {
  return <AdminLayout>{page}</AdminLayout>;
};

export default CreateProduct;
