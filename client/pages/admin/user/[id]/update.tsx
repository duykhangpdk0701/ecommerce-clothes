import AdminLayout from "@/layout/AdminLayout";
import Head from "next/head";
import { useRouter } from "next/router";
import React, { ChangeEvent, ReactElement, useState } from "react";
import { NextPageWithLayout } from "../../../_app";
import { SubmitHandler, useForm } from "react-hook-form";
import * as yup from "yup";
import UpdateUserAdminTemplate from "@/components/templates/admin/user/update";
import { yupResolver } from "@hookform/resolvers/yup";
import { useQuery } from "react-query";
import adminUserAPI from "@/api/admin/adminUserAPI";

export interface IUpdateAdminParams {
  firstName: string;
  lastName: string;
  email: string;
  phone: string;
  role: string;
}

const updateBrandSchema = yup.object({
  firstName: yup.string().required(),
  lastName: yup.string().required(),
  email: yup.string().required(),
  role: yup.string().required(),
});

const UpdateAdminUser: NextPageWithLayout = () => {
  const router = useRouter();
  const { id } = router.query;
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");
  const [file, setFile] = useState<string>();

  const {
    control,
    handleSubmit,
    setValue,
    formState: { errors },
  } = useForm<IUpdateAdminParams>({ resolver: yupResolver(updateBrandSchema) });

  const getUserById = useQuery({
    queryKey: ["user-detail", id],
    queryFn: () => {
      setLoading(true);
      if (id && typeof id !== "object") {
        return adminUserAPI.getUserById(id);
      }
      return;
    },
    onSuccess: (data) => {
      console.log(data);
      setLoading(false);
    },
    onError: (error: any) => {
      console.log(error);
      setError(error.message);
      setLoading(false);
    },
  });

  const handleSelectFile = (event: ChangeEvent<HTMLInputElement>) => {
    const { files } = event.target;
    if (files) {
      const fileLoader = URL.createObjectURL(files[0]);
      setFile(fileLoader);
    }
  };

  const onSubmit: SubmitHandler<IUpdateAdminParams> = (data) => {
    console.log(data);
  };

  return (
    <>
      <Head>
        <title>User Management | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <UpdateUserAdminTemplate
        handleSelectFile={handleSelectFile}
        control={control}
        handleSubmit={handleSubmit}
        onSubmit={onSubmit}
        errors={errors}
        isLoading={loading}
        errorResMessage={error}
        file={file}
      />
    </>
  );
};

UpdateAdminUser.getLayout = function getLayout(page: ReactElement) {
  return <AdminLayout>{page}</AdminLayout>;
};

export default UpdateAdminUser;
